<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Vendor;
use App\Good;
use DataTables;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function getVendorGoods(Request $request)
    {
        return Good::where('vendor_id',$request->vendorId)->get();
    }

    public function getGood(Request $request)
    {
        return Good::where('barcode',$request->barcode)->first();
    }

    public function cart(Request $request)
    {
        $model = Good::where('barcode',$request->barcode)->firstOrFail();
        return view('buys.cart',[
            'model' => $model,
            'cost' => $request->cost,
            'qty' => $request->qty,
        ]);
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
        $no = 1;

        do {
            $number = '02';
            $number .= date('Ymd');
            $number .= sprintf('%04d',$no++);
        } while (Buy::where('number', $number)->first());

        $model = Buy::create([
            'number' => $number,
            'total' => array_sum($request->subtotal),
        ]);

        for ($i=0; $i < count($request->barcode); $i++) { 
            $good = Good::where('barcode',$request->barcode[$i])->firstOrFail();
            $qty = $good->qty + $request->qty[$i];
            $cost = (($good->qty * $good->cost) + ($request->qty[$i] * $request->cost[$i])) / $qty;

            $model->buyDetails()->create([
                'good_barcode' => $request->barcode[$i],
                'cost' => $request->cost[$i],
                'qty' => $request->qty[$i],
            ])->good()->update([
                'qty' => $qty,
                'cost' => $cost,
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
        $buyDetails = \App\BuyDetail::where('buy_number',$id)->get();
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
                    'model' => $model->number,
                    'url_show' => route('buy.show', $model->number),
                    // 'url_edit' => route('buy.edit', $model->id),
                    // 'url_destroy' => route('buy.destroy', $model->id),
                ]);
            })
            ->make(true);
    }

    public function apiVendor(Request $request)
    {
        $data = Vendor::select(['id', 'name'])->where('name', 'LIKE', "%{$request->get('name')}%")->paginate(5);

        return response()->json([
            'items' => $data->toArray()['data'],
            'pagination' => $data->nextPageUrl() ? true : false,
        ]);
    }
}
