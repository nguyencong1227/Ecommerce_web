<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    public $table = "chitietdonhang";

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_SP', 'id' );
    }

    public $timestamps = false;
}