<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'avatar',
        'area_id',
        'priority'
    ];

    public function user()
    {
        return $this->belongsTo(related: User::class);
    }
}
