<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_creator',
        'doctor_name',
        'delivering_address',
        'pharmacy_name',
        'is_insured',
        'status',
        'creator_type',
        
    ];
}
