<?php

namespace App\Http\Controllers\Checks;

use App\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckRenovarTarjetaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Tarjeta $tarjeta)
    {
        //dd($tarjeta);
        $tarjeta->status = 0;
        $tarjeta->expedicion = NULL;
        $tarjeta->revalidacion = NULL;
        $tarjeta->save();
        return back();
    }
}
