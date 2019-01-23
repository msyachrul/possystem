<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SaleDetail;
use App\Good;
use DB;
use DataTables;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.index');
    }

    public function add(Request $request)
    {
        $item = Good::where('barcode', $request->good)->first();

        return view('sales.cart', [
            'item' => $item,
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
            $number = '01';
            $number .= date('Ymd');
            $number .= sprintf('%04d', $no++);
        } while (Sale::where('number', $number)->first());

        DB::beginTransaction();

        $model = Sale::create([
            'number' => $number,
            'total' => array_sum($request->subtotal),
        ]);        

        for ($i=0; $i < count($request->barcode); $i++) { 
            $good = Good::where('barcode', $request->barcode[$i])->firstOrFail();
            if ($good->qty < $request->qty[$i]) {
                DB::rollBack();

                return response()->json([
                    'type' => 'error',
                    'title' => 'Oops!',
                    'text' => 'Gagal menyimpan penjualan!',
                ]);
            }
            else {
                $qty = $good->qty - $request->qty[$i];

                $model->saleDetails()->create([
                    'good_barcode' => $request->barcode[$i],
                    'price' => $request->price[$i],
                    'qty' => $request->qty[$i],
                ])->good()->update([
                    'qty' => $qty,
                ]);
                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'title' => 'Sukses!',
                    'text' => 'Berhasil menyimpan penjualan!',
                ]);
            }
        }
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
