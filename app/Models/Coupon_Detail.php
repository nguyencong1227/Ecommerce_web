<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon_Detail extends Model
{
    public $table = "chitietphieunhap";

    public function product(){
    	return $this->belongsTo('App\Products','id_SP');
    }

    public $timestamps = false;
}
