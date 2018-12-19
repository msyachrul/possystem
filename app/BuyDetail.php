<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyDetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['cost', 'buy_id', 'good_id'];

    protected $dates = ['deleted_at'];

    public function buy()
    {
    	return $this->belongsTo('App\Buy');
    }
}
