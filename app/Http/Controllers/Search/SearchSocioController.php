<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Socio;
use Illuminate\Http\Request;

class SearchSocioController extends Controller
{
    public function __invoke(Request $request)
    {
        $socios = Socio::where('nombre_socio', 'like', '%'. $request->search .'%')->latest()->paginate();

        return view('socios.search', compact('socios'));
    }
}
