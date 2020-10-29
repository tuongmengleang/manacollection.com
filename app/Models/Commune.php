<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'commune';
    protected $primaryKey = 'id';
    protected $fillable = [
        'district_id',
        'name',
        'created_at',
        'updated_at'
    ];
}
