<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'quantity',
        'price',
    ];
    public function orders(){
        return $this->belongsToMany(Order::class,'orders_medicines','medicine_id','order_id')->withPivot('quantity');
    }
}
