<?php

namespace App\Http\Controllers\Export;

use App\Asociacione;
use App\Exports\SociosExcelExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportSocioExcelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $asociacion = Asociacione::where('id', $id)->orWhereNull('id')->get();

        return (new SociosExcelExport)->forDate($id)->download('SOCIOS ' . $asociacion->count() > 0 ? $asociacion[0]->nombre : 'SOCIOS - PERSONA NATURAL' . '.xlsx');
    }
}
