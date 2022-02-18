<?php

namespace App\Http\Controllers;

use App\Socio;
use App\Disenio;
use App\Vehiculo;
use App\Fotocheck;
use App\Suministro;
use App\Asociacione;
use App\TipoDocumento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\FotocheckRequest;
use Illuminate\Validation\ValidationException;

class FotocheckController extends Controller
{
    public function index()
    {
       $fotochecks = Fotocheck::where('status', 0)->latest()->paginate();
       // Para Search Advanced
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('admin.fotochecks.index', compact('fotochecks', 'vehiculos', 'asociaciones'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();
        $documentos = TipoDocumento::all();

        return view('admin.fotochecks.create', compact('vehiculos', 'asociaciones', 'documentos'));
    }

    public function store(FotocheckRequest $request)
    {
        $socioGet = Socio::where('url', 'LIKE', '%'. Str::slug($request->nombre_socio) .'%')
            ->doesnthave('fotochecks')
            ->first();

        $disenio = Disenio::select('id')->where('status', 1)->where('modelo', 0)->whereNull('deleted_at')->first();

        $suministroQuery = Suministro::query();
        $suministro = $suministroQuery->select(['id', 'fecha_utilizacion', 'conteo_monto_pvc', 'conteo_monto_cinta', 'conteo_monto_holograma'])
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->first();
        
        if (is_null($socioGet)) {
            //dd($socioGet);
            $socio = Socio::updateOrCreate([
                'nombre_socio' => $request->nombre_socio,
                'dni_socio' => $request->dni_socio,
                //'nombre_propietario' => $request->nombre_propietario,
                //'dni_propietario' => $request->dni_propietario,
                'num_placa' => $request->num_placa,
                'asociacione_id' => $request->asociacione_id,
                'vehiculo_id' => $request->vehiculo_id,
                'tipo_documento_id' => $request->tipo_documento_id,
                'tipo_persona' => $request->tipo_persona
            ]);
        }
        
        if (!isset($disenio->id)) {
            throw ValidationException::withMessages([
                'disenio' => "No hay diseño habilitado",
            ]);
        }

        if (!isset($suministro->id)) {
            throw ValidationException::withMessages([
                'suministro' => "No hay suministro habilitado",
            ]);
        }
        //dd('paso');
        $data = array_merge($request->validated(), [
            'image' => '/storage/'.$request->file('image')->store('fotos'),
            'url' => is_null($socioGet) ? $socio->url : $socioGet->url,
            'socio_id' => is_null($socioGet) ? $socio->id : $socioGet->id,
            'user_id' => auth()->user()->id,
            'disenio_id' => $disenio->id,
            'suministro_id' => $suministro->id
        ]);

        $socio = Fotocheck::create($data);

        $suministroQuery->where('id', $suministro->id)->update([
            'fecha_utilizacion' => is_null($suministro->fecha_utilizacion) ? now()->format('Y-m-d') : $suministro->fecha_utilizacion,
            'conteo_monto_pvc' => $suministro->conteo_monto_pvc + 1,
            'conteo_monto_cinta' => bcdiv($suministro->conteo_monto_pvc / 300, 1),
            'conteo_monto_holograma' => bcdiv($suministro->conteo_monto_pvc / 300, 1)
        ]);

        return redirect()->route('fotochecks.index')->with('status', $request->nombre_socio . ' fue registrado!');
    }

    public function show(Fotocheck $fotocheck)
    {
        return view('admin.fotochecks.show', compact('fotocheck'));
    }

    public function edit(Fotocheck $fotocheck)
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();
        $documentos = TipoDocumento::all();

        return view('admin.fotochecks.edit', compact('fotocheck', 'vehiculos', 'asociaciones', 'documentos'));
    }

    public function update(FotocheckRequest $request, Fotocheck $fotocheck)
    {
        //dd($request->asociacione_id);
        $placa = $fotocheck->num_placa;
        $path = $fotocheck->image;
        $url = $fotocheck->url; // OJO que si cambias el nombre también cambia la url y cuando generes el QR no saldran los datos

        $socio = Socio::where('url', $url)->update([
            'nombre_socio' => ucwords($request->nombre_socio),
            //'nombre_propietario' => $request->nombre_propietario,
            'dni_socio' => $request->dni_socio,
            'url' => $url,
            'asociacione_id' => $request->asociacione_id,
            'vehiculo_id' => $request->vehiculo_id,
            'tipo_documento_id' => $request->tipo_documento_id,
            'tipo_persona' => $request->tipo_persona
        ]);

        $fotocheck->fill( $request->validated() );

        if ($request->hasFile('image')) {
            if ($fotocheck->image != null) {
                unlink(public_path($path));
            }

            $fotocheck->update([
                'image' => '/storage/'.$request->file('image')->store('fotos')
            ]);

        }

        $fotocheck->url = $url;

        $fotocheck->save();

        return redirect()->route('fotochecks.index')->with('status', $request->nombre_socio . ' fue modificado!');
    }

    public function destroy(Fotocheck $fotocheck)
    {
        //unlink(public_path($fotocheck->image)); // Elimina la imagen
        $fotocheck->delete();

        return redirect()->route('fotochecks.index')->with('status', ' Fue eliminado!');
    }
}
