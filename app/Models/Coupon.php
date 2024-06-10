<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $table = "phieunhap";

    protected $fillable = [
        'id_NV'
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User','id_NV');
    }
    public function coupoun_detail(){
    	return $this->hasMany('App\Coupoun_Detail','id_PN');
    }

    public $timestamps = false;
}
