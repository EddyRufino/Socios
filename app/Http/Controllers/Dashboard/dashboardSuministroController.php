<?php

namespace App\Http\Controllers\Dashboard;

use App\Area;
use App\Suministro;
use Illuminate\Http\Request;
use App\Charts\SuministroChart;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class dashboardSuministroController extends Controller
{
    public function graphic()
    {
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $etiquetas = ['Tarjetas', 'Impresas', 'No Impresas'];    
        $today = today()->format('Y');
        $dateStart = "1";
        $dateLast = "12";

        $countPvc = collect([]);
        $countCinta = collect([]);
        $countholograma = collect([]);

        for ($days_backwards = $dateStart; $days_backwards <= $dateLast; $days_backwards++)
        {
            // Si quieres mostrar los suministros consuminos, busca la manera de juntar las tarjetas y fotochecks por su fecha de impresion
            $countPvc->push(Suministro::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->count());
            $countCinta->push(Suministro::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->count());
            $countholograma->push(Suministro::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->count());
        }

        $chart = new SuministroChart;
        $chartPie = new SuministroChart;

        $chart->title('Gráfico de Suministros - ' . $today);
        $chart->labels($meses);
        $chart->dataset("PVC", 'bar', $countPvc)->backgroundColor('#17a2b8');
        $chart->dataset("Cinta", 'bar', $countCinta)->backgroundColor('#ffc107');
        $chart->dataset("Holograma", 'bar', $countholograma)->backgroundColor('rgba(255, 99, 132, 0.8)');

        // Count
        $countAllPvc = Suministro::select(['monto_pvc', 'monto_cinta', 'monto_holograma', 'conteo_monto_pvc', 'conteo_monto_cinta', 'conteo_monto_holograma'])->where('status', 1)->whereNull('deleted_at')->first();

        // Torta
        $borderColors = [
            // "#17a2b8",
            // "#ffc107",
            // "#6c757d",
            
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(255, 99, 132, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            // "#17a2b8",
            // "#ffc107",
            // "#6c757d",
            
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(255, 99, 132, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

        // $chartPie->minimalist(true); 
        $chartPie->labels(['PVC', 'Cintas', 'Hologramas']);
        $chartPie->title('Gráfico de Suministros Utilizados');
        $chartPie->dataset("PVC", 'doughnut', [$countAllPvc->conteo_monto_pvc, $countAllPvc->conteo_monto_cinta, $countAllPvc->conteo_monto_holograma])->color($borderColors)->backgroundColor($fillColors);

        // Gráficos por año
        $data = Suministro::whereYear('created_at', '<=', now()->format('Y'))->orderby('created_at')->get('created_at');

        $flattened = $data->transform(function ($item) {
            return substr($item, 15, -25);
        });

        $collection = collect($flattened);
        
        $tarjetaYears = $collection->unique();
        $tarjetaYears->values();

        $allPvcYear = collect([]);
        $allCountCintas = collect([]);
        $allCountHolograma = collect([]);

        $yearStart = 2021;
        $yearLast = $tarjetaYears->last();
        
        for ($days_backwards = $yearStart; $days_backwards <= $yearLast; $days_backwards++)
        {
            $allPvcYear->push(Suministro::whereYear('created_at', $days_backwards)->count());
            $allCountCintas->push(Suministro::whereYear('created_at', $days_backwards)->count());
            $allCountHolograma->push(Suministro::whereYear('created_at', $days_backwards)->count());
        }
        
        $chartYear = new SuministroChart;
        $chartYear->labels($tarjetaYears->values());
        $chartYear->title('Gráfico de Suministro Por Años');
        $chartYear->dataset("PVC", 'line', $allPvcYear)->fill(false)->color("rgba(22,160,133, 0.4)")->backgroundColor("rgba(22,160,133, 0.4)");
        $chartYear->dataset("Cintas", 'line', $allCountCintas)->fill(false)->color("rgba(255, 205, 86, 0.6)")->backgroundColor("rgba(255, 205, 86, 0.6)");
        $chartYear->dataset("Hologramas", 'line', $allCountHolograma)->fill(false)->color("rgba(51,105,232, 0.6)")->backgroundColor("rgba(51,105,232, 0.6)");

        // GRAFICOS BAR
        $labelsBar = $chart->labels;
        $datasetsBar = $chart->datasets;
        // dd($datasetsBar);
        // GRAFICOS CIRCULAR
        $labelsPie = $chartPie->labels;
        $datasetsPie = $chartPie->datasets[0]->values;
        $dataPieOptions = $chartPie->datasets[0]->options;

        // GRAFICOS LINIA
        $labelsLine = $chartYear->labels;
        $datasetsLine = $chartYear->datasets;

        return view('admin.suministroDashboard', compact('labelsLine', 'datasetsLine','labelsPie', 'datasetsPie', 'dataPieOptions' ,'labelsBar', 'datasetsBar' ,'chart', 'chartPie', 'chartYear', 'countAllPvc'));
    }

    public function graphicPdf()
    {
        $area = Area::first();

        $pdf = PDF::loadView('admin.template.graficos.graphicSuministro', compact('area'));

        return $pdf->stream();
    }
}
