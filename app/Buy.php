<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buy extends Model
{
    use SoftDeletes;

    protected $fillable = ['number', 'total', 'vendor_id'];

    protected $dates = ['deleted_at'];

    public function buyDetails()
    {
    	return $this->hasMany('App\BuyDetail', 'buy_number', 'number');
    }
}
