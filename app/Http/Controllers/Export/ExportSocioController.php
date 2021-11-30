<?php

namespace App\Http\Controllers\Export;

use App\Socio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class ExportSocioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //$id = request()->asociacione_id_two;
        //dd($id);
        if ($id == 'natural') {

            $attributes = Socio::whereNull('asociacione_id')
                ->whereNull('deleted_at')
                ->paginate();

            $nameAsociacion = Socio::whereNull('asociacione_id')->first();

        } else {

            $attributes = Socio::where('asociacione_id', $id)
                ->whereNull('deleted_at')
                ->paginate();

            $nameAsociacion = Socio::where('asociacione_id', $id)->first();
        }
        //dd($nameAsociacion->asociacione->nombre);

        // Con Asociación
        $tarjetasCount = Socio::whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->where('asociacione_id', $id)
            ->whereNull('deleted_at')
            ->get();

        $fotochecksCount = Socio::whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->where('asociacione_id', $id)
            ->whereNull('deleted_at')
            ->get();

        // Sin Asociación
        $tarjetasCountNatural = Socio::whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        $fotochecksCountNatural = Socio::whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        $pdf = PDF::loadView('admin.export.pdf.socios', compact('attributes', 'tarjetasCount', 'fotochecksCount', 'tarjetasCountNatural', 'fotochecksCountNatural', 'nameAsociacion'));

        return $pdf->stream();
    }
}
