<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
      'product_category_id',
      'product_subcategory_id',
      'brand_id',
      'code',
      'name',
      'price',
      'discount',
      'discount_amount',
      'remark',
      'status',
      'video_link',

      'created_at',
      'updated_at'
    ];
}
