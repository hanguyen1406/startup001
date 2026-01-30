<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'travel_id',
        'name',
        'phone',
        'travel_date',
        'total_price',
        'status',
        'count',
    ];

    public function travelPackage()
    {
        return $this->belongsTo(TravelPackage::class, 'travel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
