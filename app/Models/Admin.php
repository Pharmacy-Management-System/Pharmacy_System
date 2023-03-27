<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'password'];

    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }
}
