<?php

namespace App\Exports;

use App\Socio;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class SociosExcelExport implements FromView
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
        //dd($this->id);
        if ($this->id == 'natural') {

            $attributes = Socio::whereNull('asociacione_id')
                ->whereNull('deleted_at')
                ->get();

        } else {

            $attributes = Socio::where('asociacione_id', $this->id)
                ->whereNull('deleted_at')
                ->get();

        }

        // Con Asociación
        $tarjetasCount = Socio::whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->where('asociacione_id', $this->id)
            ->whereNull('deleted_at')
            ->get();

        $fotochecksCount = Socio::whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->where('asociacione_id', $this->id)
            ->whereNull('deleted_at')
            ->get();

        // Sin Asociación
        $tarjetasCountNatural = Socio::whereHas('tarjetas', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        $fotochecksCountNatural = Socio::whereHas('fotochecks', function($query) {
                $query->whereNull('deleted_at');
            })
            ->whereNull('asociacione_id')
            ->whereNull('deleted_at')
            ->get();

        return view('admin.export.excel.socios', compact('attributes', 'tarjetasCount', 'fotochecksCount', 'tarjetasCountNatural', 'fotochecksCountNatural'));
    }
}
