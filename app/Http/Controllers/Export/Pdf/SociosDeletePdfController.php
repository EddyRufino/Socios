<?php

namespace App\Http\Controllers\Export\Pdf;

use App\Area;
use App\Socio;
use App\Tarjeta;
use App\Fotocheck;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class SociosDeletePdfController extends Controller
{
    public function sociosIndex()
    {
        $socios = Socio::onlyTrashed()->latest()->paginate(4);
        
        return view('admin.template.delete.socios', compact('socios'));
    }

    public function tarjetasIndex()
    {
        $tarjetas = Tarjeta::onlyTrashed()->latest()->paginate(2);

        return view('admin.template.delete.tarjetas', compact('tarjetas'));
    }

    public function fotochecksIndex()
    {
        $fotochecks = Fotocheck::onlyTrashed()->latest()->paginate(2);

        return view('admin.template.delete.fotochecks', compact('fotochecks'));
    }

    public function socios()
    {
        $socios = Socio::onlyTrashed()->get();

        $area = Area::first();
        
        $pdf = PDF::loadView('admin.export.pdf.delete.socios', compact('socios', 'area'));

        return $pdf->stream();
    }

    public function tarjetas()
    {
        $tarjetas = Tarjeta::onlyTrashed()->get();

        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.delete.tarjetas', compact('tarjetas', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function fotochecks()
    {
        $fotochecks = Fotocheck::onlyTrashed()->get();

        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.delete.fotochecks', compact('fotochecks', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
