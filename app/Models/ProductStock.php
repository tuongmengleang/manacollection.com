<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stocks';
    protected $fillable = [
      'id',
      'product_id',
      'quantity',

      'created_at',
      'updated_at'
    ];

    public function product(){
      $this->belongsTo(Product::class,'product_id', 'id');
    }
}
