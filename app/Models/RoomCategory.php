<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'base_price'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function availabilities()
    {
        return $this->hasMany(DailyAvailability::class);
    }
}

