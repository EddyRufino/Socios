<?php

namespace App\Exports;

use App\Fotocheck;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TodoFotochecksExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $attributes = Fotocheck::whereNull('deleted_at')->get();

        return view('admin.export.excel.todoFotocheks', compact('attributes'));
    }
}
