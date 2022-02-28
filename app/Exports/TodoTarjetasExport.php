<?php

namespace App\Exports;

use App\Tarjeta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TodoTarjetasExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        // $attributes = Tarjeta::whereNull('deleted_at')->get();
        $attributes = Tarjeta::whereNull('deleted_at')
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


        return view('admin.export.excel.todoTarjetas', compact('attributes'));
    }
}
