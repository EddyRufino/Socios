<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Correlativo;
use App\Http\Requests\TarjetaRequest;
use App\Socio;
use App\Tarjeta;
use App\Vehiculo;
use Illuminate\Http\Request;

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
        $inicio = Correlativo::select('num_correlativo')->where('tipo', 1)->get();
        $num_correlativo = $inicio[0]->num_correlativo;

        return view('admin.tarjetas.create', compact('vehiculos', 'asociaciones', 'num_correlativo'));
    }

    public function store(TarjetaRequest $request)
    {

        $socio = Socio::updateOrCreate([
            'nombre_socio' => $request->nombre_socio,
            'dni_socio' => $request->dni_socio,
            'nombre_propietario' => $request->nombre_propietario,
            'dni_propietario' => $request->dni_propietario,
            'num_placa' => $request->num_placa,
            'asociacione_id' => $request->asociacione_id,
            'vehiculo_id' => $request->vehiculo_id
        ]);

        Tarjeta::create(array_merge(
            $request->validated(), [
                'socio_id' => $socio->id,
                'num_correlativo' => now()->format('Y') .'-'. $request->num_correlativo,
                'url' => $socio->url,
                'user_id' => auth()->user()->id
            ])
        );

        Correlativo::where('tipo', 1)->update([
            'num_correlativo' => $request->num_correlativo
        ]);

        return redirect()->route('tarjetas.index')->with('status', $socio->nombre_socio . ' fue registrado!');
    }

    public function show(Tarjeta $socio)
    {
        return view('admin.tarjetas.show', compact('socio'));
    }

    public function edit(Tarjeta $tarjeta)
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();
        $inicio = Correlativo::select('num_correlativo')->where('tipo', 1)->get();
        $num_correlativo = $inicio[0]->num_correlativo;

        return view('admin.tarjetas.edit', compact('tarjeta', 'vehiculos', 'asociaciones', 'num_correlativo'));
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
            'vehiculo_id' => $request->vehiculo_id
        ]);

        $tarjeta = $tarjeta->fill($request->validated());

        $tarjeta->url = $url;

        //$tarjeta->asociacione_id = $socio->asociacione_id ? $socio->asociacione_id : 1;

        $tarjeta->save();

        return redirect()->route('tarjetas.index')->with('status', $request->nombre_socio . ' fue modificado!');
    }

    public function destroy(Tarjeta $tarjeta)
    {
        $tarjeta = $tarjeta->delete();

        return redirect()->route('tarjetas.index')->with('status', 'Fue eliminado!');
    }
}
