<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Requests\FotocheckRequest;
use App\Socio;
use App\TipoDocumento;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        //dd($socioGet);
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
                'tipo_documento_id' => $request->tipo_documento_id
            ]);
        }
        //dd('paso');
        $data = array_merge($request->validated(), [
            'image' => '/storage/'.$request->file('image')->store('fotos'),
            'url' => is_null($socioGet) ? $socio->url : $socioGet->url,
            'socio_id' => is_null($socioGet) ? $socio->id : $socioGet->id,
            'user_id' => auth()->user()->id
        ]);

        $socio = Fotocheck::create($data);

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
            'tipo_documento_id' => $request->tipo_documento_id
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
