<?php

namespace App\Http\Controllers;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Requests\FotocheckRequest;
use App\Socio;
use App\Vehiculo;
use Illuminate\Http\Request;

class FotocheckController extends Controller
{
    public function index()
    {
       $fotochecks = Fotocheck::where('status', 0)->latest()->paginate();
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
        //dd($request->asociacione_id);
        $socio = Socio::updateOrCreate([
            'nombre_socio' => $request->nombre_socio,
            'dni_socio' => $request->dni_socio,
            'asociacione_id' => $request->asociacione_id
        ]);

        $data = array_merge($request->validated(), [
            'image' => '/storage/'.$request->file('image')->store('fotos'),
            'url' => $socio->url,
            'socio_id' => $socio->id,
            'user_id' => auth()->user()->id
        ]);

        $socio = Fotocheck::create($data);

        return redirect()->route('fotochecks.index')->with('status', $request->nombre_socio . ' fue registrado!');
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
        //dd($request->asociacione_id);
        $path = $fotocheck->image;
        $url = $fotocheck->url; // OJO que si cambias el nombre también cambia la url y cuando generes el QR no saldran los datos

        $socio = Socio::where('url', $url)->update([
            'nombre_socio' => ucwords($request->nombre_socio),
            'dni_socio' => $request->dni_socio,
            'url' => $url,
            'asociacione_id' => $request->asociacione_id
        ]);

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

        $fotocheck->save();

        return redirect()->route('fotochecks.index')->with('status', $request->nombre_socio . ' fue modificado!');
    }

    public function destroy(Fotocheck $fotocheck)
    {
        unlink(public_path($fotocheck->image)); // Elimina la imagen
        $fotocheck->delete();

        return redirect()->route('fotochecks.index')->with('status', ' Fue eliminado!');
    }
}
