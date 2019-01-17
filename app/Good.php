<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
    use SoftDeletes;

    protected $fillable = ['barcode', 'name', 'qty', 'cost', 'price', 'good_category_id'];

    protected $dates = ['deleted_at'];

    public function goodCategory()
    {
    	return $this->belongsTo('App\GoodCategory');
    }
}
