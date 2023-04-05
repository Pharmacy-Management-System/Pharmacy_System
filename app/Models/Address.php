<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'area_id',
        'street_name',
        'building_number',
        'floor_number',
        'flat_number',
        'is_main',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function order(){
        return $this->hasMany(Order::class,'delivering_address_id');
    }

}
