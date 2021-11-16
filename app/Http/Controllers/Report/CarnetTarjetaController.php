<?php

namespace App\Http\Controllers\Report;

use App\Tarjeta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CarnetTarjetaController extends Controller
{
    public function anverso($anverso)
    {
        $tarjeta = Tarjeta::where('id', $anverso)->get();

        QrCode::size(200)->generate(route('tarjetas.show', $tarjeta[0]->url), '../public/tarjetasQR/'. $tarjeta[0]->url .'.svg');

        $pdf = PDF::loadView('admin.export.tarjeta', compact('tarjeta'));

        // https://www.srcodigofuente.es/aprender-php/guia-dompdf-completa
        $pdf->setPaper(array(0, 0, 320, 550), 'landscape');

        return $pdf->stream();
        // return $pdf->download('carnet-anverso.pdf');
    }
}
