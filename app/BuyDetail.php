<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyDetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['cost', 'qty','buy_file_number', 'good_barcode'];

    protected $dates = ['deleted_at'];

    public function buy()
    {
    	return $this->belongsTo('App\Buy', 'buy_file_number', 'file_number');
    }

    public function good()
    {
    	return $this->belongsTo('App\Good', 'good_barcode', 'barcode');
    }
}
