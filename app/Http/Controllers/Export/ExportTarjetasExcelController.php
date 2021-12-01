<?php

namespace App\Http\Controllers\Export;

use App\Asociacione;
use App\Exports\TarjetaExcelExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportTarjetasExcelController extends Controller
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

        if ($asociacion->count() > 0) {
            $name = $asociacion[0]->nombre;
        }else {
            $name = 'PERSONA NATURAL';
        }

        //dd(is_null($asociacion));

        return (new TarjetaExcelExport)->forDate($id)->download('TARJETAS - ' . $name . '.xlsx');
    }
}
