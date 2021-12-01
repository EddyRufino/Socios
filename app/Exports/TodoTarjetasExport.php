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
        $attributes = Tarjeta::whereNull('deleted_at')->get();

        return view('admin.export.excel.todoTarjetas', compact('attributes'));
    }
}
