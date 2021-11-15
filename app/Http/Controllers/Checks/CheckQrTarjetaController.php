<?php

namespace App\Http\Controllers\Checks;

use App\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckQrTarjetaController extends Controller
{
    public function __invoke(Tarjeta $tarjeta)
    {
        $tarjeta->status = 1;
        $tarjeta->save();
        return back();
    }
}
