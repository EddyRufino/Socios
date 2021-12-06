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

        if ($id == 'natural') {

            $attributes = Socio::whereNull('asociacione_id')
                ->where('tipo_documento_id', '!=', 3)
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = 'natural';
        }

        elseif ($id == 'juridica') {

            $attributes = Socio::whereNull('asociacione_id')
                ->where('tipo_documento_id', 3)
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = 'juridica';
        } else {

            $attributes = Socio::where('asociacione_id', $id)
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = Socio::where('asociacione_id', $id)->first();
        }

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

        // Sin Asociación - Persona Natural
        $tarjetasCountNatural = Socio::where('tipo_documento_id', '!=', 3)->whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        $fotochecksCountNatural = Socio::where('tipo_documento_id', '!=', 3)->whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        // Sin Asociación - Persona Jurídica
        $tarjetasCountJuridica = Socio::where('tipo_documento_id', 3)->whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        $fotochecksCountJuridica = Socio::where('tipo_documento_id', 3)->whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        $pdf = PDF::loadView('admin.export.pdf.socios', compact('attributes', 'tarjetasCount', 'fotochecksCount', 'tarjetasCountNatural', 'fotochecksCountNatural', 'nameAsociacion', 'tarjetasCountJuridica', 'fotochecksCountJuridica'));

        return $pdf->stream();
    }
}
