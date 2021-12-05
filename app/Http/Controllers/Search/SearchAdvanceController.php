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

            $attributes = Socio::whereNull('asociacione_id')
                ->where('tipo_documento_id', '!=', 3)
                ->whereNull('deleted_at')
                ->paginate();

        } elseif ($asociacion == 'juridica') {

            $attributes = Socio::whereNull('asociacione_id')
                ->where('tipo_documento_id', 3)
                ->whereNull('deleted_at')
                ->paginate();

        } else {

            $attributes = Socio::where('asociacione_id', $asociacion)
                ->whereNull('deleted_at')
                ->paginate();
        }

        $attributes->appends(['asociacione_id_two' => $asociacion]);

        // Con Asociación
        $tarjetasCount = Socio::whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->where('asociacione_id', $asociacion)
            ->whereNull('deleted_at')
            ->get();
        //$tarjetasCount = DB::table('socios')
                    //->whereExists(function ($query) use($asociacion){
                        //$query->select(DB::raw(1))
                            //->from('tarjetas')
                            //->where('asociacione_id', $asociacion)
                            //->whereNull('deleted_at')
                            //->whereRaw('tarjetas.socio_id = socios.id');
                   //})
                   //->get();


        $fotochecksCount = Socio::whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->where('asociacione_id', $asociacion)
            ->whereNull('deleted_at')
            ->get();
        //$fotochecksCount = DB::table('socios')
                    //->whereExists(function ($query) use($asociacion){
                        //$query->select(DB::raw(1))
                            //->from('fotochecks')
                            //->where('asociacione_id', $asociacion)
                            //->whereNull('deleted_at')
                            //->whereRaw('fotochecks.socio_id = socios.id');
                   //})
                   //->get();



        // Sin Asociación - Persona Natural
        $tarjetasCountNatural = Socio::where('tipo_documento_id', '!=', 3)->whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        //$tarjetasCountNatural = DB::table('socios')
                    //->whereExists(function ($query) use($asociacion){
                        //$query->select(DB::raw(1))
                            //->from('tarjetas')
                            //->whereNull('asociacione_id')
                            //->whereNull('deleted_at')
                            //->whereRaw('tarjetas.socio_id = socios.id');
                   //})
                   //->get();

        //dd($tarjetasCountNatural);

        $fotochecksCountNatural = Socio::where('tipo_documento_id', '!=', 3)->whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();
        //$fotochecksCountNatural = DB::table('socios')
                    //->whereExists(function ($query) use($asociacion){
                        //$query->select(DB::raw(1))
                            //->from('fotochecks')
                            //->whereNull('asociacione_id')
                            //->whereNull('deleted_at')
                            //->whereRaw('fotochecks.socio_id = socios.id');
                   //})
                   //->get();

        // Sin Asociacion - Entidad Privada
        $tarjetasCountJuridica = Socio::where('tipo_documento_id', 3)->whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        $fotochecksCountJuridica = Socio::where('tipo_documento_id', 3)->whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        //dd($fotochecksCountNatural);
        //dd($attributes[0]->fotochecks->count());
        //dd($fotochecksCountNatural);

    return view('admin.search.advancedTwo', compact('vehiculos', 'asociaciones', 'attributes', 'tarjetasCount', 'fotochecksCount', 'tarjetasCountNatural', 'fotochecksCountNatural', 'tarjetasCountJuridica', 'fotochecksCountJuridica'));
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
