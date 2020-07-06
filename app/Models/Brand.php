<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = ['brand_name', 'category', 'brand_image', 'about', 'url', 'created_at', 'updated_at'];
}
