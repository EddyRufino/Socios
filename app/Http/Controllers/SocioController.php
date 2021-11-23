<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Http\Requests\SocioRquest;
use App\Socio;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocioController extends Controller
{
    public function index()
    {
        $socios = Socio::where('status', 0)->latest()->paginate();

        //dd($socios);

        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('socios.index', compact('socios', 'vehiculos', 'asociaciones'));
    }

    public function create()
    {
        return view('socios.create');
    }

    //public function store(SocioRquest $request)
    //{
        //$socio = Socio::create( $request->validated() );

        //return redirect()->route('socios.index')->with('status', $socio->nombre_socio . ' fue registrado!');
    //}

    public function show(Socio $socio)
    {
        return view('socios.show', compact('socio'));
    }

    public function edit(Socio $socio)
    {
        return view('socios.edit', compact('socio'));
    }

    public function update(SocioRquest $request, Socio $socio)
    {
        //dd($socio);
        $url = $socio->url;

        $socio->fill($request->validated());

        $socio->url = $url;

        $socio->save();

        return redirect()->route('socios.index')->with('status', $socio->nombre_socio . ' fue modificado!');
    }

    public function destroy(Socio $socio)
    {
        unlink(public_path($socio->image)); // Elimina la imagen
        $socio->delete();

        return redirect()->route('socios.index')->with('status', $socio->nombre_socio . ' fue eliminado!');
    }
}
