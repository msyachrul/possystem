<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Views\SaleTransaction;
use App\Good;
use App\Sale;
use App\Buy;
use App\Charts\DashboardChart;
use Faker\Factory as Faker;

class DashboardController extends Controller
{
    public function buyChart()
    {
        $chart = new DashboardChart;

        // hanya ambil 30 data terakhir
        $buys = Buy::select(['number', 'total'])->orderBy('number', 'DESC')->limit(30)->get();
        
        $data = [
            'number' => [],
            'total' => [],
        ];

        foreach ($buys as $buy) {
            $data['number'][] = $buy->number;
            $data['total'][] = $buy->total;
        }

        $chart->options([
            'title' => [
                'display' => true,
                'fontSize' => 24,
                'text' => 'Grafik Pembelian',
            ],
        ]);
        $chart->labels($data['number']);
        $chart->dataset('Total', 'line', $data['total'])->color('blue')->fill(false);
        $chart->displayLegend(false);

        return $chart;
    }

    public function saleChart()
    {
        $chart = new DashboardChart;

        // hanya ambil 30 data terakhir
        $sales = Sale::select(['number', 'total'])->orderBy('number', 'DESC')->limit(30)->get();
        
        $data = [
            'number' => [],
            'total' => [],
        ];

        foreach ($sales as $sale) {
            $data['number'][] = $sale->number;
            $data['total'][] = $sale->total;
        }

        $chart->options([
            'title' => [
                'display' => true,
                'fontSize' => 24,
                'text' => 'Grafik Penjualan',
            ],
        ]);
        $chart->labels($data['number']);
        $chart->dataset('Total', 'line', $data['total'])->color('green')->fill(false);
        $chart->displayLegend(false);

        return $chart;
    }

    public function profitChart()
    {
        $chart = new DashboardChart;

        // hanya ambil 30 data terakhir
        $profits = SaleTransaction::select(['number', 'profit_total'])->orderBy('number', 'DESC')->limit(30)->get();

        $data = [
            'number' => [],
            'total' => [],
        ];

        foreach ($profits as $profit) {
            $data['number'][] = $profit->number;
            $data['total'][] = $profit->profit_total;
        }

        $chart->options([
            'title' => [
                'display' => true,
                'fontSize' => 24,
                'text' => 'Grafik Keuntungan',
            ],
        ]);
        $chart->labels($data['number']);
        $chart->dataset('Total', 'line', $data['total'])->color('red')->fill(false);
        $chart->displayLegend(false);

        return $chart;
    }

    public function saleGoodChart()
    {
        $chart = new DashboardChart;

        $goods = SaleTransaction::select(['name', DB::raw('SUM(qty) as qty')])->groupBy('name')->get();

        $data = [
            'name' => [],
            'total' => [],
            'bgColor' => [],
        ];

        foreach ($goods as $good) {
            $data['name'][] = $good->name;
            $data['total'][] = $good->qty;
            $data['bgColor'][] = Faker::create()->hexcolor;
        }

        $chart->options([
            'title' => [
                'display' => true,
                'fontSize' => 24,
                'text' => 'Barang Terlaris',
            ],
            'legend' => [
                'position' => 'right',
                'labels' => [
                    'fontSize' => 18,
                ],
            ],
        ]);
        $chart->labels($data['name']);
        $chart->dataset('Total', 'doughnut', $data['total'])->backgroundColor($data['bgColor']);

        return $chart;
    }

    public function profitGoodChart()
    {
        $chart = new DashboardChart;

        $goods = SaleTransaction::select(['name', DB::raw('SUM(profit_total) as profit_total')])->groupBy('name')->get();

        $data = [
            'name' => [],
            'total' => [],
            'bgColor' => [],
        ];

        foreach ($goods as $good) {
            $data['name'][] = $good->name;
            $data['total'][] = $good->profit_total;
            $data['bgColor'][] = Faker::create()->hexcolor;
        }

        $chart->options([
            'title' => [
                'display' => true,
                'fontSize' => 24,
                'text' => 'Profit Terbesar',
            ],
            'legend' => [
                'position' => 'right',
                'labels' => [
                    'fontSize' => 18,
                ],
            ],
        ]);
        $chart->labels($data['name']);
        $chart->dataset('Total', 'doughnut', $data['total'])->backgroundColor($data['bgColor']);

        return $chart;
    }

    public function index()
    {        
    	$model = [
    		'stock' => Good::sum('qty'),
            'buy' => Buy::sum('total'),
            'sale' => Sale::sum('total'),
            'profit' => SaleTransaction::sum('profit_total'),
    	];    	

    	return view('index',[
            'model' => $model,
            'chartBuy' => $this->buyChart(),
            'chartSale' => $this->saleChart(),
            'chartProfit' => $this->profitChart(),
            'chartSaleGood' => $this->saleGoodChart(),
            'chartProfitGood' => $this->profitGoodChart(),
        ]);
    }
}
