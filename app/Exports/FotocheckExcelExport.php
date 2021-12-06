<?php

namespace App\Exports;

use App\Fotocheck;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class FotocheckExcelExport implements FromView
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

            $attributes = Fotocheck::where('tipo', 2)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id')->where('tipo_documento_id', '!=', 3);
                })
                ->whereNull('deleted_at')
                ->get();

        } elseif ($this->id == 'juridica') {

            $attributes = Fotocheck::where('tipo', 2)
                ->whereHas('socio', function($query) {
                    $query->whereNull('asociacione_id')->where('tipo_documento_id', 3);
                })
                ->whereNull('deleted_at')
                ->get();

        } else {

            $attributes = Fotocheck::where('tipo', 2)
                ->whereHas('socio', function($query) {
                    $query->where('asociacione_id', $this->id);
                })
                ->whereNull('deleted_at')
                ->get();
        }

        return view('admin.export.excel.fotochecks', compact('attributes'));
    }
}
