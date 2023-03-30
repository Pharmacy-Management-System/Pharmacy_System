<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'email',
        'name',
        'password',
        'avatar',
        'pharmacy_id',
        'is_banned'
    ];

    protected $hidden = [
        'password'
    ];

    public function user()
    {
        return $this->belongsTo(related: User::class);
    }
}
