<?php

namespace App\Http\Controllers;

use App\Socio;
use Illuminate\Http\Request;
use App\Http\Requests\SocioRquest;
use Illuminate\Support\Facades\Storage;

class SocioController extends Controller
{
    public function index()
    {
        $socios = Socio::where('status', 0)->latest()->paginate();
        return view('socios.index', compact('socios'));
    }

    public function create()
    {
        return view('socios.create');
    }

    public function store(SocioRquest $request)
    {
        $socio = Socio::create( $request->all() );

        return redirect()->route('socios.index')->with('status', $socio->nombre_socio . ' fue registrado!');
    }

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
        $path = $socio->image;

        $socio->fill( $request->validated() );

        if ($request->hasFile('image')) {
            if ($socio->image != null) {
                unlink(public_path($path));
            }

            $socio->update([
                'image' => '/storage/'.$request->file('image')->store('fotos')
            ]);

        }

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
