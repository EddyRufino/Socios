<?php

namespace App\Http\Controllers\Search;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Controllers\Controller;
use App\Vehiculo;
use Illuminate\Http\Request;

class SearchFotocheckController extends Controller
{
    public function __invoke(Request $request)
    {
       // Para Search Advanced
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        $fotochecks = Fotocheck::where('nombre_socio', 'like', '%'. $request->search .'%')
            ->orWhere('dni_socio', 'like', '%'. $request->search .'%')
            ->latest()
            ->paginate();

        $fotochecks->appends(['search' => $request->search]);

        return view('admin.fotochecks.search', compact('fotochecks', 'vehiculos', 'asociaciones'));
    }
}
