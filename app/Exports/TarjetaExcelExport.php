<?php

namespace App\Exports;

use App\Tarjeta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TarjetaExcelExport implements FromView
{
    use Exportable;

    private $id;

    public function forDate($id)
    {
        $this->id = $id;

        return $this;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if ($this->id == 'natural') {

            $attributes = Tarjeta::where('tipo', 1)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id');
                })
                ->whereNull('deleted_at')
                ->get();

        } else {

            $attributes = Tarjeta::where('tipo', 1)
                ->whereHas('socio', function($query) {
                    $query->where('asociacione_id', $this->id);
                })
                ->whereNull('deleted_at')
                ->get();
        }

        return view('admin.export.excel.tarjetas', compact('attributes'));
    }
}
