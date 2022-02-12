<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Requests\SocioRquest;
use App\Socio;
use App\User;
use App\Tarjeta;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocioController extends Controller
{
    public function index()
    {
        // $socios = Socio::where('status', 0)->first();
        // $socioss = Socio::get('id');
        $socios = Socio::where('status', 0)
            ->with([
                'tarjetas' => function($query) {
                    $query->select('id', 'socio_id');
                },
                'fotochecks' => function($query) {
                    $query->select('id', 'socio_id');
                },
                'asociacione' => function($query) {
                    $query->select('id', 'nombre');
                },
                'vehiculo' => function($query) {
                    $query->select('id', 'nombre');
                },
            ])
            ->paginate(15, ['id', 'url', 'nombre_socio', 'dni_socio', 'num_placa', 'asociacione_id', 'tipo_documento_id', 'vehiculo_id']);
            // ->first(['id', 'url', 'nombre_socio', 'dni_socio', 'num_placa', 'asociacione_id', 'tipo_documento_id', 'vehiculo_id']);
        // dd($socios);


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
        //dd($socio->url);

        //unlink(public_path($socio->image)); // Elimina la imagen
        $socio->tarjetas()->delete();
        $socio->fotochecks()->delete();
        $socio->delete();

        return redirect()->route('socios.index')->with('status', 'Fue eliminado!');
    }
}
