<?php

namespace App\Http\Controllers;

use App\Buy;
use DataTables;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buys.index');
    }

    public function goods(Request $request)
    {
        $barcode = [1, $request->barcode];

        if (preg_match('[\W]', $request->barcode)) {
            $barcode = explode('*', $request->barcode);
        }

        return view('buys.good',[
            'qty' => $barcode[0],
            'model' => \App\Good::where('barcode',$barcode[1])->firstOrFail(),
        ]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('buys.buy');
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
            $fileNumber = date('dmy');
            $fileNumber .= sprintf('%04d',$no++);
        } while (Buy::where('file_number', $fileNumber)->first());

        $model = Buy::create([
            'file_number' => $fileNumber,
            'total' => array_sum(array_column($request->buys, 'subtotal')),
        ]);

        foreach ($request->buys as $key => $buy) {
            $model->buyDetails()->create([
                'good_barcode' => $buy['barcode'],
                'cost' => $buy['cost'],
                'qty' => $buy['qty'],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buyDetails = \App\BuyDetail::where('buy_file_number',$id)->get();
        return view('buys.show',compact('buyDetails'));
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
                    'model' => $model->file_number,
                    'url_show' => route('buy.show', $model->file_number),
                    // 'url_edit' => route('buy.edit', $model->id),
                    // 'url_destroy' => route('buy.destroy', $model->id),
                ]);
            })
            ->make(true);
    }
}
