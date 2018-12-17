<?php

namespace App\Http\Controllers;

use App\Vendor;
use DataTables;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    protected function column($id = null)
    {
        return [
            'name' => 'required|string|max:50|unique:vendors,name,' . $id,
            'id_card_number' => 'required|numeric|digits_between:0,30',
            'owner' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:0,16',
            'status' => 'required',
        ];
    }

    public function index()
    {
        return view('vendor.index');
    }

    public function create()
    {
        $model = new Vendor();

        return view('vendor.form',compact('model'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->column());

        Vendor::create($request->all());
    }

    public function show($id)
    {
        $model = Vendor::findOrFail($id);

        return view('vendor.show',compact('model'));
    }

    public function edit($id)
    {
        $model = Vendor::findOrFail($id);

        return view('vendor.form',compact('model'));   
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->column($id));

        Vendor::find($id)->update($request->all());
    }

    public function destroy($id)
    {
        Vendor::findOrFail($id)->delete();
    }

    public function vendorApi()
    {
        $model = Vendor::query();

        return DataTables::of($model)
            ->addIndexColumn()
            ->editColumn('status', function ($model) {
                return ($model->status) ? 'Aktif' : 'Tidak aktif';
            })
            ->addColumn('action', function ($model) {
                return view('templates._action', [
                    'model' => $model,
                    'url_show' => route('vendor.show', $model->id),
                    'url_edit' => route('vendor.edit', $model->id),
                    'url_destroy' => route('vendor.destroy', $model->id),
                ]);
            })
            ->make(true);
    }
}
