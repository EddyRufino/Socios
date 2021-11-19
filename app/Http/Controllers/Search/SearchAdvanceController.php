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
        $asociacion = request()->tre;

        if ($tipo == 1) {
            $tarjetas = Tarjeta::where('tipo', $tipo)
                ->where('vehiculo_id', $vehiculo)
                ->where('asociacione_id', $asociacion)
                ->paginate();

            //dd($tarjetas);
            $tarjetas->appends(['tipo' => $tipo]);
            $tarjetas->appends(['vehiculo_id' => $vehiculo]);
            $tarjetas->appends(['asociacione_id' => $asociacion]);

            return view('admin.search.advancedTarjetas', compact('vehiculos', 'asociaciones', 'tarjetas'));
        }
        else {
            $fotochecks = Fotocheck::where('tipo', $tipo)
                ->where('vehiculo_id', $vehiculo)
                ->where('asociacione_id', $asociacion)
                ->paginate();

            $fotochecks->appends(['tipo' => $tipo]);
            $fotochecks->appends(['vehiculo_id' => $vehiculo]);
            $fotochecks->appends(['asociacione_id' => $asociacion]);

            return view('admin.search.advancedFotochecks', compact('vehiculos', 'asociaciones', 'fotochecks'));
        }
    }

    public function advancedTwo()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        $asociacion = request()->asociacione_id_two;

        $attributes = Asociacione::where('id', $asociacion)->get();

        $countTarjetas = $attributes[0]->tarjetas->count();
        $countFotochecks = $attributes[0]->fotochecks->count();

        $countMoto = $attributes[0]->tarjetas[0]->vehiculo_id;
//        dd($countMoto);

        return view('admin.search.advancedTwo', compact('vehiculos', 'asociaciones', 'attributes'));
    }

    public function advancedTree()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        $asociacion = request()->asociacione_id_tree;

        $attributes = Asociacione::where('id', $asociacion)->get();

        //dd($attributes);

        return view('admin.search.advancedTree', compact('vehiculos', 'asociaciones', 'attributes'));
    }
}
