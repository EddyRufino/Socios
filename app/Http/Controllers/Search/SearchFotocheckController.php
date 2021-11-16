<?php

namespace App\Http\Controllers\Search;

use App\Fotocheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchFotocheckController extends Controller
{
    public function __invoke(Request $request)
    {
        $fotochecks = Fotocheck::where('nombre_socio', 'like', '%'. $request->search .'%')
            ->orWhere('dni_socio', 'like', '%'. $request->search .'%')
            ->latest()
            ->paginate();

        $fotochecks->appends(['search' => $request->search]);

        return view('admin.fotochecks.search', compact('fotochecks'));
    }
}
