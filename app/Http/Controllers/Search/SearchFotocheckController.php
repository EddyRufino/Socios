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

        //$fotochecks = Socio::whereHas('fotochecks', function($query) {
                //$query->where('tipo', 2)
                    //->where('num_placa', 'like', '%'. request()->search .'%')
                    //->orWhere('url', 'like', '%'. request()->search .'%');
            //})
            //->latest()
            //->paginate();
        $fotochecks = Fotocheck::whereHas('socio', function($query) {
            $query->where('nombre_socio', 'like', '%'. request()->search .'%')
                ->orWhere('num_placa', 'like', '%'. request()->search .'%')
                ->orWhere('dni_socio', 'like', '%'. request()->search .'%');
        })
        ->latest()
        ->paginate();

        //dd($fotochecks);

        $fotochecks->appends(['search' => $request->search]);

        //dd($fotochecks[0]->fotochecks[0]->id);

        return view('admin.fotochecks.search', compact('fotochecks', 'vehiculos', 'asociaciones'));
    }
}
