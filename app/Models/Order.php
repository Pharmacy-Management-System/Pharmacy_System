<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PhpParser\Node\Attribute;

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
    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function medicines(): BelongsToMany{
        return $this->belongsToMany(Medicine::class,'orders_medicines','order_id','medicine_id')->withPivot('quantity');
    }


}
