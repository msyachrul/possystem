<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Views\SaleTransaction;
use App\Good;
use App\Sale;
use App\Buy;

class DashboardController extends Controller
{
    public function index()
    {
    	$model = [
    		'stock' => Good::sum('qty'),
            'buy' => Buy::where('created_at', 'LIKE', date('Y-m').'%')->sum('total'),
            'sale' => Sale::where('created_at', 'LIKE', date('Y-m').'%')->sum('total'),
    		'profit' => SaleTransaction::where('number', 'LIKE', '%'.date('ym').'%')->sum('profit_total'),
    	];    	

    	return view('index',compact('model'));
    }
}
