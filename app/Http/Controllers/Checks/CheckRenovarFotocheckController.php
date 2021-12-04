<?php

namespace App\Http\Controllers\Checks;

use App\Fotocheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckRenovarFotocheckController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Fotocheck $fotocheck)
    {
        //dd($fotocheck);
        $fotocheck->status = 0;
        $fotocheck->expedicion = NULL;
        //$fotocheck->revalidacion = date('Y-m-d', strtotime("+1 years"));
        $fotocheck->save();
        return back();
    }
}
