<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['price', 'qty','sale_number', 'good_barcode'];

    protected $dates = ['deleted_at'];

    public function sale()
    {
    	return $this->belongsTo('App\Sale', 'sale_number', 'number');
    }

    public function good()
    {
    	return $this->belongsTo('App\Good', 'good_barcode', 'barcode');
    }
}
