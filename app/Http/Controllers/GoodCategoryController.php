<?php

namespace App\Http\Controllers;

use App\GoodCategory;
use Illuminate\Http\Request;
use DataTables;

class GoodCategoryController extends Controller
{
    protected function column($id = null)
    {
        return [
            'name' => 'required|string|max:50',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('goods.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new GoodCategory();
        return view('goods.categories.form',compact('model'));
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
        GoodCategory::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoodCategory  $goodCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = GoodCategory::findOrFail($id);
        return view('goods.categories.show',compact('model'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoodCategory  $goodCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = GoodCategory::findOrFail($id);
        return view('goods.categories.form',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoodCategory  $goodCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->column($id));
        GoodCategory::findOrFail($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoodCategory  $goodCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GoodCategory::findOrFail($id)->delete();
    }

    public function goodCategoryApi()
    {
        $model = GoodCategory::query();

        return DataTables::of($model)
            ->addIndexColumn()
            ->addColumn('action', function ($model) {
                return view('templates._action', [
                    'model' => $model->name,
                    'url_show' => route('good_category.show', $model->id),
                    'url_edit' => route('good_category.edit', $model->id),
                    'url_destroy' => route('good_category.destroy', $model->id),
                ]);
            })
            ->make(true);
    }

}
