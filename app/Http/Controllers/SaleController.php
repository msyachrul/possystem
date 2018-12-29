<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Good;
use DataTables;
use Exception;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function cart(Request $request)
    {
        $search = [1, $request->search];

        if (strpos($request->search, '*')) {
            $search = explode('*', $request->search);
        }

        $model = Good::where('barcode',$search[1])->orWhere('name',$search[1])->firstOrFail();

        return view('sales.good',[
            'qty' => $search[0],
            'model' => $model,
        ]);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no = 1;

        do {
            $number = '01';
            $number .= date('dmy');
            $number .= sprintf('%04d',$no++);
        } while (Sale::where('number', $number)->first());

        $model = Sale::create([
            'number' => $number,
            'total' => array_sum($request->subtotal),
        ]);

        for ($i=0; $i < count($request->barcode); $i++) { 
            $good = Good::where('barcode',$request->barcode[$i])->firstOrFail();
            $qty = $good->qty - $request->qty[$i];

            $model->saleDetails()->create([
                'good_barcode' => $request->barcode[$i],
                'price' => $request->price[$i],
                'qty' => $request->qty[$i],
            ])->good()->update([
                'qty' => $qty,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saleDetails = \App\SaleDetail::where('sale_number',$id)->get();
        return view('sales.show',compact('saleDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saleApi()
    {
        $model = Sale::query();

        return DataTables::of($model)
            ->addIndexColumn()
            ->editColumn('total', function($model) {
                return 'Rp ' . number_format($model->total);
            })
            ->addColumn('action', function ($model) {
                return view('templates._action', [
                    'model' => $model->number,
                    'url_show' => route('sale.show', $model->number),
                    // 'url_edit' => route('buy.edit', $model->id),
                    // 'url_destroy' => route('buy.destroy', $model->id),
                ]);
            })
            ->make(true);
    }
}
