<?php

namespace App\Exports;

use App\Socio;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TodoSociosExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $attributes = Socio::whereNull('deleted_at')->get();

        return view('admin.export.excel.todoSocios', compact('attributes'));
    }
}
