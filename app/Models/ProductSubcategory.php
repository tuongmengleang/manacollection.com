<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $table = 'product_subcategories';
    protected $fillable = ['product_category_id', 'subcategory_name', 'created_at', 'updated_at'];

    // Many To One
    public function categories(){
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }
}
