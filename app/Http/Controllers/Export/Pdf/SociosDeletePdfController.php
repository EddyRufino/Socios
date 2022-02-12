<?php

namespace App\Http\Controllers\Export\Pdf;

use App\Area;
use App\Socio;
use App\Tarjeta;
use App\Fotocheck;
use App\Charts\PrintChart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class SociosDeletePdfController extends Controller
{
    public function sociosIndex()
    {
        $socios = Socio::onlyTrashed()->latest()->paginate(4);
        
        return view('admin.template.delete.socios', compact('socios'));
    }

    public function tarjetasIndex()
    {
        $tarjetas = Tarjeta::onlyTrashed()->latest()->paginate(2);

        return view('admin.template.delete.tarjetas', compact('tarjetas'));
    }

    public function fotochecksIndex()
    {
        $fotochecks = Fotocheck::onlyTrashed()->latest()->paginate(2);

        return view('admin.template.delete.fotochecks', compact('fotochecks'));
    }

    public function socios()
    {
        $socios = Socio::onlyTrashed()->get();

        $area = Area::first();
        
        $pdf = PDF::loadView('admin.export.pdf.delete.socios', compact('socios', 'area'));

        return $pdf->stream();
    }

    public function tarjetas()
    {
        $tarjetas = Tarjeta::onlyTrashed()->get();
        $area = Area::first();

        $days = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
        $today = today()->format('Y-m');

        $dataTarjetas = collect([]);
        $dataFotochecks = collect([]);

        $dataTarjetas->push(Tarjeta::where('status', 1)->count());
        $dataFotochecks->push(Fotocheck::where('status', 1)->count());

        $chart = new PrintChart;

        $today = today()->format('M Y');
        $chart->labels($days);
        $chart->dataset("Tarjetas - {$today}", 'bar', $dataTarjetas)->backgroundColor('rgba(63, 191, 127, .6)');
        $chart->dataset("Fotochecks - {$today}", 'bar', $dataFotochecks)->backgroundColor('rgba(236, 227, 92, .6)');

        // $myChart = json_encode([
        //         'type' => 'bar',
        //         'data' => [
        //           'labels' => ['January', 'February', 'March', 'April', 'May'],
        //           'datasets' => [
        //             'label' => 'Dogs',
        //             'data' => [ 50, 60, 70, 180, 190 ]
        //         ], 
        //             'label' => 'Cats',
        //             'data' => [ 100, 200, 300, 400, 500 ]
        //         ]
        // ],true);

        // $myChart = json_decode($myChart);
        // dd($myChart);
        // return view('admin.dashboard', compact('chart', 'dataTarjetas', 'dataFotochecks', 'suministro'));

        $pdf = PDF::loadView('admin.export.pdf.delete.tarjetas', compact('tarjetas', 'area', 'dataTarjetas', 'dataFotochecks'));

        $pdf->setPaper('a4', 'landscape');

        // $pdf->setOptions(['enable_javascript' => true]);
        // $pdf->setOptions(['enable_javascript' => true]);
        // $pdf->setOptions(['javascript_delay' => 13500]);
        // $pdf->setOptions(['enable_smart_shrinking' => true]);
        // $pdf->setOptions(['no_stop_slow_scripts' => true]);

        return $pdf->stream();
    }

    public function fotochecks()
    {
        $fotochecks = Fotocheck::onlyTrashed()->get();

        $area = Area::first();

        $pdf = PDF::loadView('admin.export.pdf.delete.fotochecks', compact('fotochecks', 'area'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
