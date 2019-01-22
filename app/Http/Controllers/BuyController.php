<?php

namespace App\Http\Controllers;

use App\Buy;
use App\Vendor;
use App\Good;
use DB;
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

    public function add(Request $request)
    {
        $item = Good::where('barcode', $request->good)->first();

        return view('buys.cart', [
            'item' => $item,
            'cost' => $request->cost,
            'qty' => $request->qty,
        ]);

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

        DB::beginTransaction();

        try {
            $model = Buy::create([
                'number' => $number,
                'total' => array_sum($request->subtotal),
                'vendor_id' => $request->vendor,
            ]);

            for ($i=0; $i < count($request->barcode); $i++) { 
                $good = Good::where('barcode',$request->barcode[$i])->first();
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

            DB::commit();
            
            return response()->json([
                'status' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 'fail',
            ]);
        }
    }

    public function apiVendor(Request $request)
    {
        $data = Vendor::select(['id', 'name'])->where('name', 'LIKE', "%{$request->get('name')}%")->paginate(10);

        return response()->json([
            'items' => $data->toArray()['data'],
            'pagination' => $data->nextPageUrl() ? true : false,
        ]);
    }

    public function apiGood(Request $request)
    {
        $data = Good::select(['barcode', 'name', 'cost'])->where('barcode', 'LIKE', "{$request->get('search')}%")->orWhere('name', 'LIKE', "{$request->get('search')}%")->paginate(10);

        return response()->json([
            'items' => $data->toArray()['data'],
            'pagination' => $data->nextPageUrl() ? true : false,
        ]);
    }
}
