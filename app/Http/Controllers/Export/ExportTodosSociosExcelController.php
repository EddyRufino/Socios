<?php

namespace App\Http\Controllers\Export;

use App\Exports\TodoSociosExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportTodosSociosExcelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return (new TodoSociosExport)->download('TODOS-LOS-SOCIOS.xlsx');
    }
}
