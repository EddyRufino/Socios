<?php

namespace App\Http\Controllers;

use App\Tarjeta;
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
        return view('admin.tarjetas.create');
    }

    public function store(Request $request)
    {
        //
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
