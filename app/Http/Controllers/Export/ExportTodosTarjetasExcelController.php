<?php

namespace App\Http\Controllers\Export;

use Illuminate\Http\Request;
use App\Exports\TodoTarjetasExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportTodosTarjetasExcelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return (new TodoTarjetasExport)->download('TODAS-LAS-TARJETAS.xlsx');
    }
}
