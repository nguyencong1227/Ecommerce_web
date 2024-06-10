<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $table = "danhmucsanpham";
    public $timestamps = false;

    public function products(){
    	return $this->hasMany('App\Models\Product','category_product_id');
    }

    public function category_product_parent(){
    	return $this->belongsTo(CategoryProduct::class, 'id_DMSPCha');
    }
}
