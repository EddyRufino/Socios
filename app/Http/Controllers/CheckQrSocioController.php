<?php

namespace App\Http\Controllers;

use App\Socio;
use Illuminate\Http\Request;

class CheckQrSocioController extends Controller
{
    public function __invoke(Socio $socio)
    {
        $socio->status = 1;
        $socio->save();
        return back();
    }
}
