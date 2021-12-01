<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Socio;
use App\Tarjeta;
use Barryvdh\DomPDF\Facade as PDF;

class ExportTarjetasController extends Controller
{
    public function __invoke($id)
    {
        if ($id == 'natural') {

            $attributes = Tarjeta::where('tipo', 1)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id');
                })
                ->whereNull('deleted_at')
                ->get();

        } else {

            $attributes = Tarjeta::where('tipo', 1)
                ->whereHas('socio', function($query) use ($id) {
                    $query->where('asociacione_id', $id);
                })
                ->whereNull('deleted_at')
                ->get();
        }

        //dd($attributes);
        //QrCode::size(200)->generate(route('tarjetas.show', $attributes[0]->url), '../public/tarjetasQR/'. $tarjeta[0]->url .'.svg');

        $pdf = PDF::loadView('admin.export.pdf.tarjetas', compact('attributes'));

        $pdf->setPaper(array(0, 0, 320, 550), 'landscape');

        return $pdf->stream();
    }
}
