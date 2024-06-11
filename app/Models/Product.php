<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "sanpham";
    const LIST_SIZE= [
        '28' => 28,
        '29' => 29,
        '30' => 30,
        '31' => 31,
        '32' => 32,
        '33' => 33,
        '34' => 34,
        '35' => 35,
        '36' => 36,
        '37' => 37,
        '38' => 38,
        '39' => 39,
        '40' => 40,
        '41' => 41,
        '42' => 42,
        '43' => 43,
        '44' => 44,
        '45' => 45,
        'XS' => 'XS',
        'S' => 'S',
        'M' => 'M',
        'L' => 'L',
        'XL' => 'XL',
        'XXL' => 'XXL',
        '4XL' => '4XL'
    ];

	protected $fillable = [
        'id_NCC', 'id_DMSP', 'Ten', 'Gia', 'MoTa', 'SoLuong', 'size', 'Anh', 'TrangThai', 'SLBan', 'XLXem'
    ];

    public function category_product(){
    	return $this->belongsTo('App\Models\CategoryProduct', 'id_DMSP', 'id');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'id_NCC', 'id');
    }

    public $timestamps = false;
}