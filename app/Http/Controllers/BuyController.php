<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Vendor;
use App\Good;
use DataTables;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function getGoods(Request $request)
    {
        $goods = Good::where('vendor_id',$request->vendorId)->get();

        if($goods->isNotEmpty()) {            
            return view('buys.good',compact('goods'));
        }
    }

    public function getGood(Request $request)
    {
        return Good::where('barcode',$request->barcode)->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buys.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vendors = Vendor::orderBy('name','ASC')->get();
        return view('buys.form',compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buy  $buy
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
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buyApi()
    {
        $model = Buy::query();

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
