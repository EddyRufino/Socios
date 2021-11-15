<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Http\Requests\TarjetaRequest;
use App\Tarjeta;
use App\Vehiculo;
use Illuminate\Http\Request;

class TarjetaController extends Controller
{
    public function index()
    {
       $tarjetas = Tarjeta::latest()->paginate();

       //dd($tarejetas);
        return view('admin.tarjetas.index', compact('tarjetas'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('admin.tarjetas.create', compact('vehiculos', 'asociaciones'));
    }

    public function store(TarjetaRequest $request)
    {
        $socio = Tarjeta::create($request->validated());

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

        return view('admin.tarjetas.edit', compact('tarjeta', 'vehiculos', 'asociaciones'));
    }

    public function update(TarjetaRequest $request, Tarjeta $tarjeta)
    {
        $socio = $tarjeta->fill($request->validated());
        $socio->save();

        return redirect()->route('tarjetas.index')->with('status', $socio->nombre_socio . ' fue modificado!');
    }

    public function destroy(Tarjeta $tarjeta)
    {
        //
    }
}
