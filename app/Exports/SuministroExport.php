<?php

namespace App\Exports;

use App\Suministro;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class SuministroExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $attributes = Suministro::whereNull('deleted_at')->get();

        return view('admin.export.excel.suministro', compact('attributes'));
    }
}
