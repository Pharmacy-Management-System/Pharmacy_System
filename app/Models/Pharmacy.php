<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'email',
        'name',
        'password',
        'avatar',
        'area_id',
        'priority'
    ];

    protected $hidden = [
        'password'
    ];
}