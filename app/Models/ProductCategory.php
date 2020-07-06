<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = ['category_name', 'type_name', 'created_at', 'updated_at'];

    // HasMany from Product SubCategory
    public function subcategories(){
        return $this->hasMany(ProductSubCategory::class, 'product_category_id','id');
    }
}
