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
        'cost_price',
        'sale_price',
        'discount',
        'discount_amount',
        'remark',
        'status',
        'video_link',

        'created_at',
        'updated_at'
    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function subcategory(){
        return $this->belongsTo(ProductSubcategory::class, 'product_subcategory_id', 'id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
