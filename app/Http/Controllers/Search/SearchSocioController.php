<?php

namespace App\Http\Controllers\Search;

use App\Asociacione;
use App\Http\Controllers\Controller;
use App\Socio;
use App\Vehiculo;
use Illuminate\Http\Request;

class SearchSocioController extends Controller
{
    public function __invoke(Request $request)
    {
        $socios = Socio::where('nombre_socio', 'like', '%'. $request->search .'%')
            ->orWhere('dni_socio', 'like', '%'. $request->search .'%')
            ->orWhere('num_placa', 'like', '%'. $request->search .'%')
            ->latest()
            ->paginate();

        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        return view('socios.search', compact('socios', 'vehiculos', 'asociaciones'));
    }
}
