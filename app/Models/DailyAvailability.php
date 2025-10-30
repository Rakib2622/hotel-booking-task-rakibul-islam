<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['room_category_id', 'date', 'booked_rooms'];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
}

