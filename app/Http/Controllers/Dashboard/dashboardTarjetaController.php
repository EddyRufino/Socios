<?php

namespace App\Http\Controllers\Dashboard;

use App\Tarjeta;
use App\Charts\TarjetaChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardTarjetaController extends Controller
{
    public function __invoke()
    {
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $etiquetas = ['Tarjetas', 'Impresas', 'No Impresas'];    
        $today = today()->format('Y-m');
        $dateStart = "1";
        $dateLast = "12";

        $allTarjetas = collect([]);
        $printCount = collect([]);
        $notPrintCount = collect([]);

        for ($days_backwards = $dateStart; $days_backwards <= $dateLast; $days_backwards++)
        {
            $allTarjetas->push(Tarjeta::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->select('id')->count());
            $printCount->push(Tarjeta::whereYear('fecha_print', now()->format('Y'))->whereMonth('fecha_print', $days_backwards)->where('status', 1)->count());
            $notPrintCount->push(Tarjeta::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->where('status', 0)->count());
        }
        // dd($printCount);
        $chart = new TarjetaChart;
        $chartPie = new TarjetaChart;

        $today = today()->format('M Y');
        $chart->title('Gráfico de Tarjetas');
        $chart->labels($meses);
        $chart->dataset("Tarjetas", 'bar', $allTarjetas)->backgroundColor('#17a2b8');
        $chart->dataset("Impresas", 'bar', $printCount)->backgroundColor('#ffc107');
        $chart->dataset("No Impresas", 'bar', $notPrintCount)->backgroundColor('rgba(255, 99, 132, 0.8)');
        

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

        $countAllTarjetas = collect([]);
        $countNotPrint = collect([]);
        $countPrint = collect([]);

        // Count
        $countAllTarjetas->push(Tarjeta::select('id')->count());
        $countNotPrint->push(Tarjeta::where('status', 0)->count());
        $countPrint->push(Tarjeta::where('status', 1)->count());
        
        // $chartPie->minimalist(true);
        $chartPie->labels(['Tarjetas', 'Impresas', 'No Impresas']);
        $chartPie->title('Gráfico de Tarjetas');
        $chartPie->dataset("Tarjetas", 'doughnut', [$countAllTarjetas[0], $countNotPrint[0], $countPrint[0]])->color($borderColors)->backgroundColor($fillColors);

        return view('admin.tarjetaDashboard', compact('chart', 'chartPie', 'countAllTarjetas', 'countNotPrint', 'countPrint'));
    }
}
