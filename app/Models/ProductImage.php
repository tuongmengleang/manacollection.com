<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    protected $fillable = [
      'product_id',
      'original_images',
      'resize_image',

      'created_at',
      'updated_at'
    ];

    public function product(){
        $this->belongsTo(Product::class,'product_id', 'id');
    }
}
