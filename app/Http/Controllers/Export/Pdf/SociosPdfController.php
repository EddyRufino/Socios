<?php

namespace App\Http\Controllers\Export\Pdf;

use App\Area;
use App\Socio;
use App\Tarjeta;
use App\Fotocheck;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class SociosPdfController extends Controller
{
    public function tarjetas($id)
    {
        if ($id == 'natural') {

            $attributes = Tarjeta::where('tipo', 1)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id')->where('tipo_documento_id', '!=', 3);
                })
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = 'natural';

        } elseif ($id == 'juridica') {

            $attributes = Tarjeta::where('tipo', 1)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id')->where('tipo_documento_id', 3);
                })
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = 'juridica';

        } else {

            $attributes = Tarjeta::where('tipo', 1)
                ->whereHas('socio', function($query) use ($id) {
                    $query->where('asociacione_id', $id);
                })
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = Socio::where('asociacione_id', $id)->first();
        }

        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.tarjeta-circulacion', compact('attributes', 'nameAsociacion', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function fotochecks($id)
    {
        if ($id == 'natural') {

            $attributes = Fotocheck::where('tipo', 2)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id')->where('tipo_documento_id', '!=', 3);
                })
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = 'natural';

        } elseif ($id == 'juridica') {

            $attributes = Fotocheck::where('tipo', 2)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id')->where('tipo_documento_id', 3);
                })
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = 'juridica';

        } else {

            $attributes = Fotocheck::where('tipo', 2)
                ->whereHas('socio', function($query) use ($id) {
                    $query->where('asociacione_id', $id);
                })
                ->whereNull('deleted_at')
                ->get();

            $nameAsociacion = Socio::where('asociacione_id', $id)->first();
        }

        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.fotochecks', compact('attributes', 'nameAsociacion', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
