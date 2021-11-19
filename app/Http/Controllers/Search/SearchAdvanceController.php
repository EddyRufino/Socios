<?php

namespace App\Http\Controllers\Search;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Controllers\Controller;
use App\Tarjeta;
use App\Vehiculo;
use Illuminate\Http\Request;

class SearchAdvanceController extends Controller
{
    public function advanced()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        $tipo = request()->tipo;
        $vehiculo = request()->vehiculo_id;
        $asociacion = request()->asociacione_id;

        if ($tipo == 1) {
            $tarjetas = Tarjeta::where('tipo', $tipo)
                ->where('vehiculo_id', $vehiculo)
                ->where('asociacione_id', $asociacion)
                ->paginate(1);

            $tarjetas->appends(['tipo' => $tipo]);
            $tarjetas->appends(['vehiculo_id' => $vehiculo]);
            $tarjetas->appends(['asociacione_id' => $asociacion]);

            return view('admin.search.advancedTarjetas', compact('vehiculos', 'asociaciones', 'tarjetas'));
        }
        else {
            $fotochecks = Fotocheck::where('tipo', $tipo)
                ->where('vehiculo_id', $vehiculo)
                ->where('asociacione_id', $asociacion)
                ->paginate(1);

            $fotochecks->appends(['tipo' => $tipo]);
            $fotochecks->appends(['vehiculo_id' => $vehiculo]);
            $fotochecks->appends(['asociacione_id' => $asociacion]);

            return view('admin.search.advancedFotochecks', compact('vehiculos', 'asociaciones', 'fotochecks'));
        }
    }
}
