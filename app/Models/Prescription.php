<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'order_id'
    ];
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
