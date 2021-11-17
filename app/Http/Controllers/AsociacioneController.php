<?php

namespace App\Http\Controllers;

use App\Asociacione;
use Illuminate\Http\Request;

class AsociacioneController extends Controller
{
    public function index()
    {
        $asociaciones = Asociacione::latest()->paginate();
        return view('admin.asociaciones.index', compact('asociaciones'));
    }

    public function create()
    {
        return view('admin.asociaciones.create');
    }

    public function store(Request $request)
    {
        $data = Asociacione::create($request->all());

        return redirect()->route('asociaciones.index')->with('status', $data->nombre . ' fue registrado!');
    }

    public function edit(Asociacione $asociacione)
    {
        return view('admin.asociaciones.edit', compact('asociacione'));
    }

    public function update(Request $request, Asociacione $asociacione)
    {
        $asociacione->update($request->all());

        return redirect()->route('asociaciones.index')->with('status', $asociacione->nombre . ' fue modificado!');
    }

    public function destroy(Asociacione $asociacione)
    {
        //
    }
}
