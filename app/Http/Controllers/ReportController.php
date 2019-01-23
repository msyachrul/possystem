<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\BuyDetail;
use App\Good;
use App\SaleDetail;
use App\Views\SaleTransaction;

class ReportController extends Controller
{
	public function stock()
	{
		return view('reports.stock');
	}

	public function buy()
	{
		return view('reports.buy');
	}

    public function sale()
    {
    	return view('reports.sale');
    }

    public function transaction()
    {
    	return view('reports.transaction');
    }

    // REST API

    public function apiStock()
    {
    	$model = Good::select([DB::raw('CONCAT(barcode, " - ", name) as name'), 'updated_at as last_purchase', 'cost', 'qty', DB::raw('cost * qty as subtotal')]);

    	return DataTables::of($model)
    		->addIndexColumn()
            ->editColumn('last_purchase', function ($model) {
                return date('d/m/Y', strtotime($model->last_purchase));
            })
    		->editColumn('cost', function ($model) {
    			return 'Rp ' . number_format($model->cost);
    		})
    		->editColumn('subtotal', function ($model) {
    			return 'Rp ' . number_format($model->subtotal);
    		})
    		->make(true);
    }

    public function apiBuy()
    {
    	$model = BuyDetail::join('goods', 'buy_details.good_barcode', 'goods.barcode')
    		->select([
    			'buy_details.buy_number as number',
    			DB::raw('CONCAT(goods.barcode, " - ", goods.name) as name'),
    			'buy_details.cost as cost',
    			'buy_details.qty as qty',
    			DB::raw('buy_details.cost * buy_details.qty as subtotal'),
    		]);

		return DataTables::of($model)
			->addIndexColumn()
			->editColumn('cost', function ($model) {
				return 'Rp ' . number_format($model->cost);
			})
			->editColumn('subtotal', function ($model) {
				return 'Rp ' . number_format($model->subtotal);
			})
			->make(true);
    }

    public function apiSale()
    {
        $model = SaleDetail::join('goods','sale_details.good_barcode','goods.barcode')
        	->select([
    			'sale_details.id as id',
    			'sale_details.sale_number as number',
    			DB::raw('CONCAT(goods.barcode, " - ", goods.name) as name'),
    			'sale_details.price as price',
    			'sale_details.qty as qty',
    			DB::raw('sale_details.price * sale_details.qty as subtotal'),
        	]);

        return DataTables::of($model)
            ->addIndexColumn()
            ->editColumn('price', function ($model) {
                return "Rp " . number_format($model->price);
            })
            ->editColumn('subtotal', function ($model) {
                return "Rp " . number_format($model->subtotal);
            })
            ->make(true);
    }

    public function apiTransaction()
    {
        $model = SaleTransaction::select(['number', DB::raw('sum(cost_total) as cost_total'), DB::raw('sum(price_total) as price_total'), DB::raw('sum(profit_total) as profit_total')])->groupBy('number');

    	return DataTables::of($model)
    		->addIndexColumn()
            ->editColumn('cost_total', function ($model) {
                return 'Rp '. number_format($model->cost_total);
            })
            ->editColumn('price_total', function ($model) {
                return 'Rp '. number_format($model->price_total);
            })
            ->editColumn('profit_total', function ($model) {
                return 'Rp '. number_format($model->profit_total);
            })
    		->make(true);
    }
}
