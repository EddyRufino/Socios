<?php

namespace App\Http\Controllers;

use App\Tarjeta;
use App\Bitacora;
use App\Fotocheck;
use App\Socio;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function indexTarjeta()
    {
        $ids = Bitacora::where('tipo', 1)->pluck('id')->unique();
        $bitacoras = Tarjeta::whereIn('id', $ids)->withTrashed()->where('tipo', 1)->paginate();
        // dd($bitacoras);
        return view('admin.template.bitacoras.indexTarjeta', compact('bitacoras'));
    }

    public function showTarjeta($id)
    {
        $nombre_socio = Socio::whereHas('tarjetas', function($query) use ($id) {
            return $query->withTrashed()->where('id', $id);
        })->get('nombre_socio');

        $tarjetas = Bitacora::where('id', $id)->where('tipo', 1)->get();

        return view('admin.template.bitacoras.showTarjeta', compact('tarjetas', 'nombre_socio'));
    }

    public function indexFotocheck()
    {
        $ids = Bitacora::where('tipo', 2)->pluck('id')->unique();
        $bitacoras = Fotocheck::whereIn('id', $ids)->withTrashed()->where('tipo', 2)->paginate();
        
        return view('admin.template.bitacoras.indexFotocheck', compact('bitacoras'));
    }

    public function showFotocheck($id)
    {
        $nombre_socio = Socio::whereHas('fotochecks', function($query) use ($id) {
            return $query->withTrashed()->where('id', $id);
        })->get('nombre_socio');

        $fotochecks = Bitacora::where('id', $id)->where('tipo', 2)->get();

        return view('admin.template.bitacoras.showFotocheck', compact('fotochecks', 'nombre_socio'));
    }
}
