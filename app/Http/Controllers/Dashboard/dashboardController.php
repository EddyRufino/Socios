<?php

namespace App\Http\Controllers\Dashboard;

use App\Tarjeta;
use App\Fotocheck;
use App\Charts\PrintChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function index(Request $request)
    {
        $days = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
        $today = today()->format('Y-m');

        $dataTarjetas = collect([]);
        $dataFotochecks = collect([]);

        $dataTarjetas->push(Tarjeta::where('status', 1)->count());
        $dataFotochecks->push(Fotocheck::where('status', 1)->count());

        $chart = new PrintChart;

        $today = today()->format('M Y');
        $chart->labels($days);
        $chart->dataset("Tarjetas - {$today}", 'line', $dataTarjetas)->backgroundColor('rgba(63, 191, 127, .6)');
        $chart->dataset("Fotochecks - {$today}", 'line', $dataFotochecks)->backgroundColor('rgba(236, 227, 92, .6)');

        $suministro = number_format(($dataTarjetas->implode('') + $dataFotochecks->implode('')) / 300);

        return view('admin.dashboard', compact('chart', 'dataTarjetas', 'dataFotochecks', 'suministro'));
    }
}
