<?php

namespace App\Http\Controllers;

use File;
use App\Disenio;
use Illuminate\Http\Request;

class DisenioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.template.disenios.index', [
            'disenios' => Disenio::latest()->paginate()
        ]);
    }

    public function create()
    {
        return view('admin.template.disenios.create', [
            'disenio' => new Disenio
        ]);
    }

    public function store(Request $request)
    {
    	$anverso = $request->file('anverso');
        $reverso = $request->file('reverso');
        $firma = $request->file('firma');

    	$path = public_path() . '/disenios';
	    $fileNameAnverso = uniqid() . $anverso->getClientOriginalName();
        $fileNameReverso = uniqid() . $reverso->getClientOriginalName();
        $fileNameFirma = uniqid() . $firma->getClientOriginalName();

        $moved1 = $anverso->move($path, $fileNameAnverso);
        $moved2 = $reverso->move($path, $fileNameReverso);
        $moved3 = $firma->move($path, $fileNameFirma);

    	if ($moved1 && $moved2 && $moved3) {
	    	$disenio = new Disenio();
	    	$disenio->nombre = $request->nombre;
	    	$disenio->anverso = $fileNameAnverso;
            $disenio->reverso = $fileNameReverso;
	    	$disenio->status = $request->status;
            $disenio->modelo = $request->modelo;
            $disenio->nombre_jefe = $request->nombre_jefe;
            $disenio->firma = $fileNameFirma;
	    	$disenio->save();
    	}
        //dd($moved);
        return redirect()->route('disenios.index')->with('status', $request->nombre . ' fue registrado!');
    }

    public function show(Disenio $disenio)
    {
        //
    }

    public function edit(Disenio $disenio)
    {
        return view('admin.template.disenios.edit', compact('disenio'));
    }

    public function update(Request $request, Disenio $disenio)
    {
        $anverso = $request->file('anverso');
        $reverso = $request->file('reverso');
        $firma = $request->file('firma');
        
    	$path = public_path() . '/disenios';

        if (isset($anverso)) {
            $fileNameAnverso = uniqid() . $anverso->getClientOriginalName();
            $moved1 = $anverso->move($path, $fileNameAnverso);
        }

        if (isset($reverso)) {
            $fileNameReverso = uniqid() . $reverso->getClientOriginalName();
            $moved2 = $reverso->move($path, $fileNameReverso);
        }

        if (isset($firma)) {
            $fileNameFirma = uniqid() . $firma->getClientOriginalName();
            $firmaMove = $firma->move($path, $fileNameFirma);
        }

        $disenio->nombre = $request->nombre;
        $disenio->anverso = isset($fileNameAnverso) ? $fileNameAnverso : $disenio->anverso;
        $disenio->reverso = isset($fileNameReverso) ? $fileNameReverso : $disenio->reverso;
        $disenio->status = $request->status;
        $disenio->modelo = $request->modelo;
        $disenio->nombre_jefe = $request->nombre_jefe;
        $disenio->firma = isset($fileNameFirma) ? $fileNameFirma : $disenio->firma;
        $disenio->save();

        return redirect()->route('disenios.index')->with('status', $request->nombre . ' fue Editado!');
    }

    public function destroy(Disenio $disenio)
    {
    	// eliminar el archivo
    	if (substr($disenio->anverso, 0, 4) === "http" && substr($disenio->reverso, 0, 4) === "http") {
    		$deleted = true;
    	} else {
    		$fullPathAnverso = public_path() . '/disenios/' . $disenio->anverso;
            $fullPathReverso = public_path() . '/disenios/' . $disenio->reverso;
    		$deleted = File::delete($fullPathAnverso);
            $deleted = File::delete($fullPathReverso);
    	}

    	// eliminar el registro de la img en la bd
    	if ($deleted) {
    		$disenio->delete();
    	}

    	return back()->with('status', 'Diseño eliminado!');
    }
}
