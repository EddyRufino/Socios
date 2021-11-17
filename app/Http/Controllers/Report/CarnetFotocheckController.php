<?php

namespace App\Http\Controllers\Report;

use App\Fotocheck;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CarnetFotocheckController extends Controller
{
    public function anverso($anverso) {
        $fotocheck = Fotocheck::where('id', $anverso)->get();

        QrCode::size(200)->generate(route('fotochecks.show', $fotocheck[0]->url), '../public/fotochecksQR/'. $fotocheck[0]->url .'.svg');

        $pdf = PDF::loadView('admin.export.fotocheck', compact('fotocheck'));

        // https://www.srcodigofuente.es/aprender-php/guia-dompdf-completa
        $pdf->setPaper(array(0, 0, 380, 595), 'portrait');

        return $pdf->stream();
        // return $pdf->download('carnet-anverso.pdf');
    }
}
