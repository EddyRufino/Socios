<?php

namespace App\Http\Controllers\Search;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Controllers\Controller;
use App\Socio;
use App\Vehiculo;
use Illuminate\Http\Request;

class SearchFotocheckController extends Controller
{
    public function __invoke(Request $request)
    {
       // Para Search Advanced
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        $fotochecks = Socio::where('nombre_socio', 'like', '%'. $request->search .'%')
            ->whereHas('fotochecks', function($query) {
                $query->where('tipo', 2);
            })
            ->orWhere('dni_socio', 'like', '%'. $request->search .'%')
            ->orWhere('num_placa', 'like', '%'. $request->search .'%')
            ->latest()
            ->paginate();

        $fotochecks->appends(['search' => $request->search]);

        return view('admin.fotochecks.search', compact('fotochecks', 'vehiculos', 'asociaciones'));
    }
}
