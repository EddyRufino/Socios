<?php

namespace App\Http\Controllers\Checks;

use App\Fotocheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckQrFotocheckController extends Controller
{
    public function __invoke(Fotocheck $fotocheck)
    {
        $fotocheck->status = 1;
        $fotocheck->save();
        return back();
    }
}
