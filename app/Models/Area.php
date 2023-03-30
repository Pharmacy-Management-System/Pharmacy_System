<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';

    protected $fillable = [
        'id',
        'name',
        'address',
    ];

    protected $casts = [
        'area_id' => 'integer',
    ];
}
