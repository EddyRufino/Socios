<?php

namespace App\Http\Controllers\Export\Suministro;

use App\Area;
use App\Suministro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class PdfSuministroController extends Controller
{
    public function __invoke()
    {
        $attributes = Suministro::whereNull('deleted_at')->get();
        
        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.suministro', compact('attributes', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
