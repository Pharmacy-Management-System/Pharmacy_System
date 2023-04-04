<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPrescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'prescription',
        'order_id'
    ];
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
