<?php

namespace App\Http\Controllers\Export\Pdf;

use App\Area;
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

        $area = Area::first();
        
        $pdf = PDF::loadView('admin.export.pdf.allSocios', compact('socios', 'area'));

        return $pdf->stream();
    }

    public function allTarjetas()
    {
        // $tarjetas = Tarjeta::whereNull('deleted_at')->get();
        $tarjetas = Tarjeta::whereNull('deleted_at')
            ->with([
                'socio' => function($query) {
                    $query->select(['id', 'asociacione_id', 'nombre_socio', 'nombre_propietario', 'dni_socio', 'tipo_persona'])
                        ->with(['asociacione' => function($query) {
                            $query->select(['id', 'nombre']);
                        }]);
                },
                'vehiculo' => function($query) {
                    $query->select(['id', 'nombre']);
                }
            ])
            ->get(['id', 'socio_id', 'vehiculo_id', 'num_placa', 'num_autorizacion', 'vigencia_autorizacion', 'num_operacion', 'vigencia_operacion', 'num_correlativo', 'expedicion', 'revalidacion', 'status']);


        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.allTarjetas', compact('tarjetas', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    public function allFotochecks()
    {
        $fotochecks = Fotocheck::whereNull('deleted_at')
            ->with([
                'socio' => function($query) {
                    $query->select(['id', 'asociacione_id', 'nombre_socio', 'nombre_propietario', 'dni_socio', 'tipo_persona'])
                        ->with(['asociacione' => function($query) {
                            $query->select(['id', 'nombre']);
                        }]);
                },
                'vehiculo' => function($query) {
                    $query->select(['id', 'nombre']);
                }
            ])
            ->get(['id', 'socio_id', 'vehiculo_id', 'num_autorizacion', 'expedicion', 'revalidacion', 'status']);

        // dd($fotochecks);

        // $fotochecks = Fotocheck::whereNull('deleted_at')->get();
        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.allFotochecks', compact('fotochecks', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
