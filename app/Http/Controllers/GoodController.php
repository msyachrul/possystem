<?php

namespace App\Http\Controllers;

use App\Good;
use DataTables;
use Illuminate\Http\Request;

class GoodController extends Controller
{
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
        //
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
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function show(Good $good)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function edit(Good $good)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Good $good)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function destroy(Good $good)
    {
        //
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
            ->editColumn('cost_of_good', function ($model) {
                return 'Rp '. number_format($model->cost_of_good);
            })
            ->editColumn('price', function ($model) {
                return 'Rp '. number_format($model->price);
            })
            ->addColumn('action', function ($model) {
                return view('templates._action', [
                    'model' => $model,
                    'url_show' => route('good.show', $model->id),
                    'url_edit' => route('good.edit', $model->id),
                    'url_destroy' => route('good.destroy', $model->id),
                ]);
            })
            ->make(true);
    }
}
