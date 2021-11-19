<?php

namespace App\Http\Controllers\Search;

use App\Asociacione;
use App\Http\Controllers\Controller;
use App\Tarjeta;
use App\Vehiculo;
use Illuminate\Http\Request;

class SearchTarjetaController extends Controller
{
    public function __invoke(Request $request)
    {
       // Para Search Advanced
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        $tarjetas = Tarjeta::where('nombre_socio', 'like', '%'. $request->search .'%')
            ->orWhere('dni_socio', 'like', '%'. $request->search .'%')
            ->orWhere('num_placa', 'like', '%'. $request->search .'%')
            ->latest()
            ->paginate();

        $tarjetas->appends(['search' => $request->search]);

        return view('admin.tarjetas.search', compact('tarjetas', 'vehiculos', 'asociaciones'));
    }
}
