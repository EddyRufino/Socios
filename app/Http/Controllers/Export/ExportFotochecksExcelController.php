<?php

namespace App\Http\Controllers\Export;

use App\Asociacione;
use App\Exports\FotocheckExcelExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportFotochecksExcelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $asociacion = Asociacione::where('id', $id)->get();

        if ($id == 'juridica') {
            $name = 'ENTIDAD PRIVADA';
        } elseif ($id == 'natural') {
            $name = 'PERSONA NATURAL';
        } else {
            $name = $asociacion[0]->nombre;
        }

        //dd(is_null($asociacion));

        return (new FotocheckExcelExport)->forDate($id)->download('FOTOCHECKS - ' . $name . '.xlsx');
    }
}
