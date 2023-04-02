<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'area_id',
        'street_name',
        'building_no',
        'floor_number',
        'flat_number',
        'is_main',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
