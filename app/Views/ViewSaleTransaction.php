<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class ViewSaleTransaction extends Model
{
    public function good()
    {
    	return $this->belongsTo('App\Good', 'barcode', 'barcode');
    }
}
