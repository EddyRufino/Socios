<?php

namespace App\Http\Controllers\Search;

use App\Asociacione;
use App\Fotocheck;
use App\Http\Controllers\Controller;
use App\Socio;
use App\Tarjeta;
use App\Vehiculo;
use DB;
use Illuminate\Database\Eloquent\Builder;
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
            if($vehiculo > 0) {
                $tarjetas = Tarjeta::where('tipo', $tipo)
                    ->where('asociacione_id', $asociacion)
                    ->where('vehiculo_id', $vehiculo)
                    ->paginate();
            }

            if($vehiculo == 'Vehículo') {
                $tarjetas = Tarjeta::where('tipo', $tipo)
                    ->where('asociacione_id', $asociacion)
                    ->paginate();
            }

            //dd($tarjetas);
            $tarjetas->appends(['tipo' => $tipo]);
            $tarjetas->appends(['asociacione_id' => $asociacion]);
            $tarjetas->appends(['vehiculo_id' => $vehiculo]);

            return view('admin.search.advancedTarjetas', compact('vehiculos', 'asociaciones', 'tarjetas'));
        }
        else {

            if ($tipo == 2 ) {
                if($vehiculo > 0) {
                    $fotochecks = Fotocheck::where('tipo', $tipo)
                        ->where('asociacione_id', $asociacion)
                        ->where('vehiculo_id', $vehiculo)
                        ->paginate();
                }

                if($vehiculo == 'Vehículo') {
                    $fotochecks = Fotocheck::where('tipo', $tipo)
                        ->where('asociacione_id', $asociacion)
                        ->paginate();
                }
            }

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

        if ($asociacion == 'natural') {
            $attributes = Socio::where('asociacione_id')->whereHas('tarjetas')->orWhereHas('fotochecks')->paginate();

        } else {

            $attributes = Socio::where('asociacione_id', $asociacion)->whereHas('tarjetas')->orWhereHas('fotochecks')->paginate();
        }

        //dd($attributes);
        //$tr = Socio::where('asociacione_id', $asociacion)->get();

        $tarjetasCount = Socio::whereHas('tarjetas')->where('asociacione_id', $asociacion)->count();
        $fotochecksCount = Socio::whereHas('fotochecks')->where('asociacione_id', $asociacion)->count();

        //dd($fotochecksCount);

        $tarjetasCountNatural = Socio::whereHas('tarjetas')->whereNull('asociacione_id')->count();
        $fotochecksCountNatural = Socio::whereHas('fotochecks')->whereNull('asociacione_id')->count();
        //dd($attributes[0]->fotochecks->count());
        //dd($fotochecksCountNatural);

    return view('admin.search.advancedTwo', compact('vehiculos', 'asociaciones', 'attributes', 'tarjetasCount', 'fotochecksCount', 'tarjetasCountNatural', 'fotochecksCountNatural'));
    }

    public function advancedTree()
    {
        $vehiculos = Vehiculo::all();
        $asociaciones = Asociacione::all();

        $asociacion = request()->asociacione_id_tree;
        $vehiculo = request()->vehiculo_id_tree;

        $vehiculosTree = Vehiculo::with(['tarjetas', 'fotochecks'])->where('id', $vehiculo)->get();

        dd($vehiculosTree);

        $attributes = Asociacione::where('id', $asociacion)
                //->orWhereHas('tarjetas', function(Builder $query) use($vehiculo, $asociacion) {
                    //$query->where('vehiculo_id', '=', $vehiculo)->where('asociacione_id', $asociacion);
                //})
                //->orWhere(function($subQuery) use($vehiculo) {
                    //$subQuery->whereHas('fotochecks', function($query) use($vehiculo) {
                        //$query->where('asociacione_id', $vehiculo);
                    //});
                //})
                //->orWhereHas('fotochecks', function($query) use($vehiculo, $asociacion) {
                    //$query->where('vehiculo_id', '=', $vehiculo)->where('asociacione_id', $asociacion);
                //})
                ->where(function($subQuery) use($vehiculo, $asociacion) {
                    $subQuery->whereHas('fotochecks', function($query) use($vehiculo, $asociacion) {
                        $query->where('vehiculo_id', $vehiculo);
                    });
                })
                ->get();


        dd($attributes);

        return view('admin.search.advancedTree', compact('vehiculos', 'asociaciones', 'attributes'));
    }
}
