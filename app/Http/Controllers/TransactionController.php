<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Views\ViewSaleTransaction;

class TransactionController extends Controller
{
    public function index()
    {
    	return view('transactions.index');
    }

    public function show($id)
    {
        $transactionDetails = ViewSaleTransaction::where('number',$id)->get();
        return view('transactions.show',compact('transactionDetails'));
    }

    public function apiTransaction()
    {
    	$model = ViewSaleTransaction::query()->select('number', DB::raw('sum(qty) as qty'), DB::raw('sum(total_hpp) as total_hpp'), DB::raw('sum(total_price) as total_price'), DB::raw('sum(profit) as profit'))->groupBy('number');

    	return DataTables::of($model)
    		->addIndexColumn()
            ->editColumn('total_hpp', function ($model) {
                return 'Rp '. number_format($model->total_hpp);
            })
            ->editColumn('total_price', function ($model) {
                return 'Rp '. number_format($model->total_price);
            })
            ->editColumn('profit', function ($model) {
                return 'Rp '. number_format($model->profit);
            })
            ->addColumn('action', function ($model) {
                return view('templates._action',[
                    'model' => $model->number,
                    'url_show' => route('transaction.show', $model->number),
                ]);
            })
    		->make();
    }
}
