<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Correlativo;
use App\Http\Requests\TarjetaRequest;
use App\Tarjeta;
use App\Vehiculo;
use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    public function index()
    {
       $tarjetas = Tarjeta::where('status', 0)->latest()->paginate();

        return view('admin.tarjetas.index', compact('tarjetas'));
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
        $socio = Tarjeta::create(array_merge(
            $request->validated(), [
                'num_correlativo' => now()->format('Y') .'-'. $request->num_correlativo
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

        $socio = $tarjeta->fill($request->validated());

        $tarjeta->url = $url;

        $socio->save();

        return redirect()->route('tarjetas.index')->with('status', $socio->nombre_socio . ' fue modificado!');
    }

    public function destroy(Tarjeta $tarjeta)
    {
        //$tarjeta = Tarjeta::find($tarjeta->id);
        dd($tarjeta);
    }
}
