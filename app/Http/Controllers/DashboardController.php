<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Views\SaleTransaction;
use App\Good;
use App\Sale;
use App\Buy;
use App\Charts\DashboardChart;

class DashboardController extends Controller
{
    public function index()
    {
        $chart = new DashboardChart;

        $buys = Buy::select(['created_at', 'total'])->get();

        $date = [];
        $total = [];

        foreach ($buys as $buy) {
            $date[] = date('d F', strtotime($buy->created_at));
            $total[] = $buy->total;
        }

        $chart->labels($date);
        $chart->dataset('Dashboard Chart', 'line', $total)->color('blue')->fill(false);
        $chart->displayLegend(false);

    	$model = [
    		'stock' => Good::sum('qty'),
            'buy' => Buy::where('created_at', 'LIKE', date('Y-m').'%')->sum('total'),
            'sale' => Sale::where('created_at', 'LIKE', date('Y-m').'%')->sum('total'),
    		'profit' => SaleTransaction::where('number', 'LIKE', '%'.date('ym').'%')->sum('profit_total'),
    	];    	

    	return view('index',[
            'model' => $model,
            'chart' => $chart,
        ]);
    }
}
