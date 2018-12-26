<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = ['number','total'];

    protected $dates = ['deleted_at'];

    public function saleDetails()
    {
    	return $this->hasMany('App\SaleDetail', 'sale_number', 'number');
    }
}
