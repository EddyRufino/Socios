<?php

namespace App\Http\Controllers\Report;

use App\Socio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CarnetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function anverso($anverso)
    {
        $socio = Socio::where('id', $anverso)->get();

        QrCode::size(200)->generate(route('socios.show', $socio[0]->url), '../public/qrcodes/'. $socio[0]->url .'.svg');

        //PDF::setOptions(['defaultFont' => 'sans-serif']);

        $pdf = PDF::loadView('admin.export.carnet', compact('socio'));

        // https://www.srcodigofuente.es/aprender-php/guia-dompdf-completa
        $pdf->setPaper(array(0, 0, 380, 595), 'portrait');

        return $pdf->stream();
        // return $pdf->download('carnet-anverso.pdf');
    }
}
