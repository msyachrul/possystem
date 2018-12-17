<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    protected $fillable = ['name', 'cost_of_good', 'price', 'good_category_id', 'vendor_id'];

    protected $dates = ['deleted_at'];

    public function goodCategory()
    {
    	return $this->belongsTo('App\GoodCategory');
    }

    public function vendor()
    {
    	return $this->belongsTo('App\Vendor');
    }
}
