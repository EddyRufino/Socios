<?php

namespace App\Http\Controllers;

use App\Correlativo;
use Illuminate\Http\Request;

class CorrelativoController extends Controller
{
    public function index()
    {
        $correlativos = Correlativo::all();
        return view('admin.correlativos.index', compact('correlativos'));
    }

    public function edit(Correlativo $correlativo)
    {
        return view('admin.correlativos.edit', compact('correlativo'));
    }

    public function update(Request $request, Correlativo $correlativo)
    {
        $correlativo = $correlativo->fill($request->all());

        $correlativo->save();

        return redirect()->route('correlativos.index')->with('status', 'Fue modificado!');
    }
}
