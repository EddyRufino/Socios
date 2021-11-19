<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Requests\FotocheckRequest;
use App\Vehiculo;
use Illuminate\Http\Request;

class FotocheckController extends Controller
{
    public function index()
    {
       $fotochecks = Fotocheck::latest()->paginate();
       // Para Search Advanced
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('admin.fotochecks.index', compact('fotochecks', 'vehiculos', 'asociaciones'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('admin.fotochecks.create', compact('vehiculos', 'asociaciones'));
    }

    public function store(FotocheckRequest $request)
    {
        $data = array_merge($request->validated(), [
            'image' => '/storage/'.$request->file('image')->store('fotos'),
            'asociacione_id' => $request->asociacione_id ? $request->asociacione_id : 1
        ]);

        $socio = Fotocheck::create($data);

        return redirect()->route('fotochecks.index')->with('status', $socio->nombre_socio . ' fue registrado!');
    }

    public function show(Fotocheck $fotocheck)
    {
        return view('admin.fotochecks.show', compact('fotocheck'));
    }

    public function edit(Fotocheck $fotocheck)
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('admin.fotochecks.edit', compact('fotocheck', 'vehiculos', 'asociaciones'));
    }

    public function update(FotocheckRequest $request, Fotocheck $fotocheck)
    {
        $path = $fotocheck->image;
        $url = $fotocheck->url; // OJO que si cambias el nombre también cambia la url y cuando generes el QR no saldran los datos

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

        $fotocheck->asociacione_id = $fotocheck->asociacione_id ? $fotocheck->asociacione_id : 1;

        $fotocheck->save();

        return redirect()->route('fotochecks.index')->with('status', $fotocheck->nombre_socio . ' fue modificado!');
    }

    public function destroy(Fotocheck $fotocheck)
    {
        //
    }
}
