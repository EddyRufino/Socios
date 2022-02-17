<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Socio;
use App\Charts\SocioChart;
use App\Http\Controllers\Controller;

class dashboardSocioController extends Controller
{
    public function __invoke()
    {
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $etiquetas = ['Tarjetas', 'Impresas', 'No Impresas'];    
        $today = today()->format('Y');
        $dateStart = "1";
        $dateLast = "12";

        $allSocios = collect([]);
        $allNatural = collect([]);
        $allJuridica = collect([]);
        $allExtranjeros = collect([]);

        for ($days_backwards = $dateStart; $days_backwards <= $dateLast; $days_backwards++)
        {
            $allSocios->push(Socio::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->where('tipo_persona', 1)->count());
            $allNatural->push(Socio::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->where('tipo_persona', 2)->count());
            $allJuridica->push(Socio::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->where('tipo_persona', 3)->count());
            $allExtranjeros->push(Socio::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', $days_backwards)->where('tipo_documento_id', 3)->count());
        }
        
        $chart = new SocioChart;
        $chartPie = new SocioChart;

        // $today = today()->format('M Y');
        $chart->title('Gráfico de Socios - ' . $today);
        $chart->labels($meses);
        $chart->dataset("Socios", 'bar', $allSocios)->backgroundColor('#17a2b8');
        $chart->dataset("P. Natural", 'bar', $allNatural)->backgroundColor('#ffc107');
        $chart->dataset("P. Jurídica", 'bar', $allJuridica)->backgroundColor('#007bff');
        $chart->dataset("P. Extranjero", 'bar', $allExtranjeros)->backgroundColor('#6c757d');
        

        $borderColors = [
            // "#17a2b8",
            // "#ffc107",
            // "#6c757d",
            
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(140, 140, 140, 1.0)",
            "rgba(255, 99, 132, 1.0)",
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
            "rgba(51,105,232, 0.2)",
            "rgba(140, 140, 140, 0.2)",
            "rgba(255, 99, 132, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

        $countAllSocios = collect([]);
        $allNatural = collect([]);
        $allJuridica = collect([]);
        $allExtranjeros = collect([]);

        // Count
        $countAllSocios->push(Socio::where('tipo_persona', 1)->count());
        $allNatural->push(Socio::where('tipo_persona', 2)->count());
        $allJuridica->push(Socio::where('tipo_persona', 3)->count());
        $allExtranjeros->push(Socio::where('tipo_documento_id', 3)->count());
        
        // $chartPie->minimalist(true);
        $chartPie->labels(['Socios', 'P. Natural', 'P. Jurídica', 'P. Extranjero']);
        $chartPie->title('Gráfico de Socios');
        $chartPie->dataset("Socios", 'doughnut', [$countAllSocios[0], $allNatural[0], $allJuridica[0], $allExtranjeros[0]])->color($borderColors)->backgroundColor($fillColors);

        // Gráficos por año
        $data = Socio::whereYear('created_at', '<=', now()->format('Y'))->orderby('created_at')->get('created_at');

        $flattened = $data->transform(function ($item) {
            return substr($item, 15, -25);
        });

        $collection = collect($flattened);

        $socioYears = $collection->unique();
        $socioYears->values();

        $allSociosYear = collect([]);
        $allNaturalYear = collect([]);
        $allJuridicaYear = collect([]);
        $allExtranjerosYear = collect([]);

        $yearStart = 2021;
        $yearLast = $socioYears->last();
        
        for ($days_backwards = $yearStart; $days_backwards <= $yearLast; $days_backwards++)
        {
            $allSociosYear->push(Socio::whereYear('created_at', $days_backwards)->where('tipo_persona', 1)->count());
            $allNaturalYear->push(Socio::whereYear('created_at', $days_backwards)->where('tipo_persona', 2)->count());
            $allJuridicaYear->push(Socio::whereYear('created_at', $days_backwards)->where('tipo_persona', 3)->count());
            $allExtranjerosYear->push(Socio::whereYear('created_at', $days_backwards)->where('tipo_documento_id', 3)->count());
        }
        
    
        $chartYear = new SocioChart;
        $chartYear->labels($socioYears->values());
        $chartYear->title('Gráfico de Socios Por Años');
        $chartYear->dataset("Socios", 'line', $allSociosYear)->backgroundColor("rgba(22,160,133, 0.4)");
        $chartYear->dataset("P. Natural", 'line', $allNaturalYear)->backgroundColor("rgba(255, 205, 86, 0.6)");
        $chartYear->dataset("P. Jurídica", 'line', $allJuridicaYear)->backgroundColor("rgba(51,105,232, 0.6)");
        $chartYear->dataset("P. Extranjero", 'line', $allExtranjerosYear)->backgroundColor("rgba(140, 140, 140, 0.6)");

        return view('admin.socioDashboard', compact('chartYear','chart', 'chartPie', 'countAllSocios', 'allNatural', 'allJuridica', 'allExtranjeros'));
    }
}
