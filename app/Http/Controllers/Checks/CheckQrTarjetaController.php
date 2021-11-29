<?php

namespace App\Http\Controllers\Checks;

use App\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckQrTarjetaController extends Controller
{
    public function __invoke(Tarjeta $tarjeta)
    {
        //dd($tarjeta);
        $tarjeta->status = 1;
        $tarjeta->expedicion = now()->format('Y-m-d');
        $tarjeta->revalidacion = date('Y-m-d', strtotime("+1 years"));
        $tarjeta->save();
        return back();
    }
}
