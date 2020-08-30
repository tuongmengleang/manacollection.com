<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    protected $table = 'product_infos';
    protected $fillable = [
        'id',
        'product_id',
        'color',
        'size',
        'quantity',

        'created_at',
        'updated_at'
    ];

    public function product(){
        $this->belongsTo(Product::class,'product_id', 'id');
    }
}
