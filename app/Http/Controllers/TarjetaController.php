<?php

namespace App\Http\Controllers;

use App\Socio;
use App\Disenio;
use App\Tarjeta;
use App\Vehiculo;
use App\Asociacione;
use App\Bitacora;
use App\Correlativo;
use App\TipoDocumento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\TarjetaRequest;
use App\Suministro;
use Illuminate\Validation\ValidationException;

class TarjetaController extends Controller
{
    public function index()
    {
       $tarjetas = Tarjeta::where('status', 0)->latest()->paginate();
       // Para Search Advanced
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('admin.tarjetas.index', compact('tarjetas', 'vehiculos', 'asociaciones'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();
        $documentos = TipoDocumento::all();
        $inicio = Correlativo::select('num_correlativo')->where('tipo', 1)->get();
        $num_correlativo = $inicio[0]->num_correlativo;

        return view('admin.tarjetas.create', compact('vehiculos', 'asociaciones', 'num_correlativo', 'documentos'));
    }

    public function store(TarjetaRequest $request)
    {
        $socioGet = Socio::where('url', 'LIKE', '%'. Str::slug($request->nombre_socio) .'%')
            ->doesnthave('tarjetas')
            ->first();

        $disenio = Disenio::select('id')->where('status', 1)->where('modelo', 1)->whereNull('deleted_at')->first();

        $suministroQuery = Suministro::query();
        $suministro = $suministroQuery->select(['id', 'fecha_utilizacion', 'conteo_monto_pvc', 'conteo_monto_cinta', 'conteo_monto_holograma'])
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->first();
        // dd(bcdiv($suministro->conteo_monto_pvc / 300,1));
        // dd($suministro->id);

        if (is_null($socioGet)) {
            //dd('nulo');
            $socio = Socio::updateOrCreate([
                'nombre_socio' => $request->nombre_socio,
                'dni_socio' => $request->dni_socio,
                'nombre_propietario' => $request->nombre_propietario,
                'dni_propietario' => $request->dni_propietario,
                'num_placa' => $request->num_placa,
                'asociacione_id' => $request->asociacione_id,
                'vehiculo_id' => $request->vehiculo_id,
                'tipo_documento_id' => $request->tipo_documento_id,
                'tipo_persona' => $request->tipo_persona
            ]);

        } else {
            //dd('no nulo');
            $socio = Socio::where('url', $socioGet->url)->update([
                'nombre_socio' => ucwords($socioGet->nombre_socio),
                'dni_socio' => $socioGet->dni_socio,
                'nombre_propietario' => ucwords($socioGet->nombre_propietario),
                'dni_propietario' => $socioGet->dni_propietario,
                'url' => $socioGet->url,
                'num_placa' => strtoupper($request->num_placa),
                'asociacione_id' => $socioGet->asociacione_id,
                'vehiculo_id' => $socioGet->vehiculo_id,
                'tipo_documento_id' => $socioGet->tipo_documento_id,
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

        Tarjeta::create(array_merge(
            $request->validated(), [
                'socio_id' => is_null($socioGet) ? $socio->id : $socioGet->id,
                'num_correlativo' => now()->format('Y') .'-'. $request->num_correlativo,
                'url' => is_null($socioGet) ? $socio->url : $socioGet->url,
                'user_id' => auth()->user()->id,
                'disenio_id' => $disenio->id,
                'suministro_id' => $suministro->id
            ])
        );

        Correlativo::where('tipo', 1)->update([
            'num_correlativo' => $request->num_correlativo
        ]);

        $suministroQuery->where('id', $suministro->id)->update([
            'fecha_utilizacion' => is_null($suministro->fecha_utilizacion) ? now()->format('Y-m-d') : $suministro->fecha_utilizacion,
            'conteo_monto_pvc' => $suministro->conteo_monto_pvc + 1,
            'conteo_monto_cinta' => bcdiv($suministro->conteo_monto_pvc / 300, 1),
            'conteo_monto_holograma' => bcdiv($suministro->conteo_monto_pvc / 300, 1)
        ]);

        return redirect()->route('tarjetas.index')->with('status', $request->nombre_socio . ' fue registrado!');
    }

    public function show(Tarjeta $socio)
    {
        return view('admin.tarjetas.show', compact('socio'));
    }

    public function edit(Tarjeta $tarjeta)
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();
        $documentos = TipoDocumento::all();
        $inicio = Correlativo::select('num_correlativo')->where('tipo', 1)->get();
        $num_correlativo = $inicio[0]->num_correlativo;

        return view('admin.tarjetas.edit', compact('tarjeta', 'vehiculos', 'asociaciones', 'num_correlativo', 'documentos'));
    }

    public function update(TarjetaRequest $request, Tarjeta $tarjeta)
    {
        $url = $tarjeta->url; // OJO que si cambias el nombre también cambia la url y cuando generes el QR no saldran los datos

        $socio = Socio::where('url', $url)->update([
            'nombre_socio' => ucwords($request->nombre_socio),
            'dni_socio' => $request->dni_socio,
            'nombre_propietario' => ucwords($request->nombre_propietario),
            'dni_propietario' => $request->dni_propietario,
            'url' => $url,
            'num_placa' => strtoupper($request->num_placa),
            'asociacione_id' => $request->asociacione_id,
            'vehiculo_id' => $request->vehiculo_id,
            'tipo_documento_id' => $request->tipo_documento_id,
            'tipo_persona' => $request->tipo_persona
        ]);

        $tarjeta = $tarjeta->fill($request->validated());

        $tarjeta->url = $url;

        $tarjeta->save();
        // dd($id);
        Bitacora::create([
            'id' => $tarjeta->id,
            'url' => $url,
            'nombre_socio' => $request->nombre_socio,
            'dni_socio' => $request->dni_socio,
            'nombre_propietario' => $request->nombre_propietario,
            'dni_propietario' => $request->dni_propietario,
            'asociacione_id' => $request->asociacione_id,
            'vehiculo_id' => $request->vehiculo_id,
            'tipo_documento_id' => $request->tipo_documento_id,
            'tipo_persona' => $request->tipo_persona,
            'num_placa' => $tarjeta->num_placa,
            'expedicion' => $tarjeta->expedicion,
            'revalidacion' => $tarjeta->revalidacion,
            'num_operacion' => $tarjeta->num_operacion,
            'vigencia_operacion' => $tarjeta->vigencia_operacion,
            'num_autorizacion' => $tarjeta->num_autorizacion,
            'vigencia_autorizacion' => $tarjeta->vigencia_autorizacion,
            'status' => $tarjeta->status,
            'fecha_print' => $tarjeta->fecha_print,
            'tipo' => $tarjeta->tipo,
            'num_correlativo' => $tarjeta->num_correlativo,
            'socio_id' => $tarjeta->socio_id,
            'user_id' => $tarjeta->user_id,
            'descripcion' => $tarjeta->descripcion,
            'renovado' => $tarjeta->renovado,
            'disenio_id' => $tarjeta->disenio_id,
            'renovado_count' => $tarjeta->renovado_count,
            'suministro_id' => $tarjeta->suministro_id,
            'user_modifico' => auth()->user()->id,
            'image' => NULL,
            'created_at' => now()->format('Y-m-d'),
        ]);

        return redirect()->route('tarjetas.index')->with('status', $request->nombre_socio . ' fue modificado!');
    }

    public function destroy(Tarjeta $tarjeta)
    {
        $tarjeta = $tarjeta->delete();

        return redirect()->route('tarjetas.index')->with('status', 'Fue eliminado!');
    }
}
