<?php

namespace App\Http\Controllers\Export;

use App\Asociacione;
use App\Exports\SociosExcelExport;
use App\Http\Controllers\Controller;
use App\Socio;
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

        if ($id == 'juridica') {
            $name = 'ENTIDAD PRIVADA';
        } elseif ($id == 'natural') {
            $name = 'PERSONA NATURAL';
        } else {
            $name = $asociacion[0]->nombre;
        }

        //if ($asociacion[0]->tipo_documento_id == 3 && $asociacion[0]->) {
            //$name = 'ENTIDAD PRIVADA';
        //} elseif ($asociacion[0]->tipo_documento_id != 3) {
            //$name = 'PERSONA NATURAL';
        //} else {
            //$name = $asociacion[0]->nombre;
        //}

        return (new SociosExcelExport)->forDate($id)->download('SOCIOS - ' . $name . '.xlsx');
    }
}
