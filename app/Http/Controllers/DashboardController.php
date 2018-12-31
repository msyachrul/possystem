<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Views\ViewSaleTransaction;
use App\Good;
use App\Sale;
use App\Buy;

class DashboardController extends Controller
{
    public function index()
    {
    	$model = [
    		'buy' => Buy::where('created_at', 'LIKE', date('Y-m').'%')->sum('total'),
    		'sale' => Sale::where('created_at', 'LIKE', date('Y-m').'%')->sum('total'),
    		'stock' => Good::sum('qty'),
    		'profit' => ViewSaleTransaction::where('number', 'LIKE', '%'.date('my').'%')->sum('profit'),
    	];    	

    	return view('index',compact('model'));
    }
}
