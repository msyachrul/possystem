<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buy extends Model
{
    use SoftDeletes;

    protected $fillable = ['file_number'];

    protected $dates = ['deleted_at'];

    public function buyDetails()
    {
    	return $this->hasMany('App\BuyDetail');
    }
}
