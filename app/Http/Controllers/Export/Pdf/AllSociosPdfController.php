<?php

namespace App\Http\Controllers\Export\Pdf;

use App\Socio;
use App\Tarjeta;
use App\Fotocheck;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class AllSociosPdfController extends Controller
{
    public function allSocios()
    {
        $socios = Socio::whereNull('deleted_at')->get();
        
        $pdf = PDF::loadView('admin.export.pdf.allSocios', compact('socios'));

        return $pdf->stream();
    }

    public function allTarjetas()
    {
        $tarjetas = Tarjeta::whereNull('deleted_at')->get();

        $pdf = PDF::loadView('admin.export.pdf.allTarjetas', compact('tarjetas'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function allFotochecks()
    {
        $fotochecks = Fotocheck::whereNull('deleted_at')->get();

        $pdf = PDF::loadView('admin.export.pdf.allFotochecks', compact('fotochecks'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
