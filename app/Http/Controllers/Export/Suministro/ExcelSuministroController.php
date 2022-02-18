<?php

namespace App\Http\Controllers\Export\Suministro;

use Illuminate\Http\Request;
use App\Exports\SuministroExport;
use App\Http\Controllers\Controller;

class ExcelSuministroController extends Controller
{
    public function __invoke()
    {
        return (new SuministroExport)->download('SUMINISTROS.xlsx');
    }
}
