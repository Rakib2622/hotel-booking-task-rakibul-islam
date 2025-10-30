<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone',
        'room_category_id', 'from_date', 'to_date',
        'base_price', 'final_price', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

