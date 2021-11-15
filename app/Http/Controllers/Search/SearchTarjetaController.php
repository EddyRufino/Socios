<?php

namespace App\Http\Controllers\Search;

use App\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchTarjetaController extends Controller
{
    public function __invoke(Request $request)
    {
        $tarjetas = Tarjeta::where('nombre_socio', 'like', '%'. $request->search .'%')
            ->orWhere('dni_socio', 'like', '%'. $request->search .'%')
            ->orWhere('num_placa', 'like', '%'. $request->search .'%')
            ->latest()
            ->paginate();

        $tarjetas->appends(['search' => $request->search]);

        return view('admin.tarjetas.search', compact('tarjetas'));
    }
}
