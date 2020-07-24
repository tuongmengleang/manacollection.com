<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = ['brand_name', 'category', 'brand_image', 'about', 'url', 'created_at', 'updated_at'];

    public function products(){
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
