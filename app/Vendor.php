<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'id_card_number', 'owner', 'address', 'phone_number', 'status'];

    protected $dates = ['deleted_at'];

    public function goods()
    {
    	return $this->hasMany('App\Good');
    }
}
