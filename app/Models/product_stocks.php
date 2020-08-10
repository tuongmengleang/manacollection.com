<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_stocks extends Model
{
    protected $table = 'product_stocks';
    protected $fillable = [
      'id',
      'product_id',
      'quantity',

      'created_at',
      'updated_at'
    ];
}
