<?php

namespace App\Http\Controllers;

use App\Asociacione;
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

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show(Tarjeta $tarjeta)
    {
        //
    }

    public function edit(Tarjeta $tarjeta)
    {
        //
    }

    public function update(Request $request, Tarjeta $tarjeta)
    {
        //
    }

    public function destroy(Tarjeta $tarjeta)
    {
        //
    }
}
