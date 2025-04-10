<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'name',
        
        // ✈️ PENERBANGAN
'departure_airport',
'arrival_airport',
'departure_date',
'departure_time',
'arrival_date',
'arrival_time',

// 🏨 HOTEL
'location', 
'room_type',

// 📚 KURSUS
'materi',
'pengajar',
'start_date',
'end_date',
'jam_kursus',

    
        'is_done',
    ];
    

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
