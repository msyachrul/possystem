<?php

namespace App\Http\Controllers;

use App\Good;
use App\GoodCategory;
use App\Vendor;
use DataTables;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class GoodController extends Controller
{
    protected function barcodeGenerator($request)
    {
        $faker = Faker::create();

        do {
            $barcode = sprintf('%02d', $request->good_category_id);
            $barcode .= sprintf('%04d', $faker->unique()->randomNumber(4));
        } while (Good::where('barcode',$barcode)->first());

        $newRequest = $request->all();
        $newRequest['barcode'] = $barcode;

        return $newRequest;
    }

    protected function column()
    {
        return [
            'name' => 'required|string|max:50',
            'cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'good_category_id' => 'required|integer',
            'vendor_id' => 'required|integer',
        ];
    }

    protected function categories()
    {
        $goodCategories = GoodCategory::orderBy('name')->get();
        $modelCategories = [];

        foreach ($goodCategories as $goodCategory) {
            $modelCategories[$goodCategory->id] = $goodCategory->name;
        }

        return $modelCategories;
    }

    protected function vendors()
    {
        $vendors = Vendor::orderBy('name')->get();
        $modelVendors = [];

        foreach ($vendors as $vendor) {
            $modelVendors[$vendor->id] = $vendor->name;
        }

        return $modelVendors;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('goods.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods.form',[
            'model' => new Good(),
            'modelCategories' => $this->categories(),
            'modelVendors' => $this->vendors(),
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
        $this->validate($request, $this->column());

        Good::create($this->barcodeGenerator($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Good::findOrFail($id);

        return view('goods.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('goods.form',[
            'model' => Good::findOrFail($id),
            'modelCategories' => $this->categories(),
            'modelVendors' => $this->vendors(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->column());

        if ($request->good_category_id != Good::findOrFail($id)->good_category_id) {
            Good::findOrFail($id)->update($this->barcodeGenerator($request));
        }
        else {
            Good::findOrFail($id)->update($request->all());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Good::findOrFail($id)->delete();
    }

    public function goodApi()
    {
        $model = Good::query();

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('vendor_name', function ($model) {
                return $model->vendor->name;
            })
            ->addColumn('category_name', function ($model) {
                return $model->goodCategory->name;
            })
            ->editColumn('cost', function ($model) {
                return 'Rp '. number_format($model->cost);
            })
            ->editColumn('price', function ($model) {
                return 'Rp '. number_format($model->price);
            })
            ->addColumn('action', function ($model) {
                return view('templates._action', [
                    'model' => $model->name,
                    'url_show' => route('good.show', $model->id),
                    'url_edit' => route('good.edit', $model->id),
                    'url_destroy' => route('good.destroy', $model->id),
                ]);
            })
            ->make(true);
    }
}
