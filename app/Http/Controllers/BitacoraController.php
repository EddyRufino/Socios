<?php

namespace App\Http\Controllers;

use App\Tarjeta;
use App\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function indexTarjeta()
    {
        $ids = Bitacora::pluck('id')->unique();
        $bitacoras = Tarjeta::whereIn('id', $ids)->paginate();
        
        // dd($bitacoras);

        return view('admin.template.bitacoras.indexTarjeta', compact('bitacoras'));
    }

    public function showTarjeta($id)
    {
        $tarjetas = Bitacora::where('id', $id)->get();
        return view('admin.template.bitacoras.showTarjeta', compact('tarjetas'));
    }
}
