<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'guest_name',
        'contact',
        'ref_code',
        'confirmed_at',

        // ✈️ PENERBANGAN
        'boarding_time',

        // 🏨 HOTEL / PENGINAPAN
        'checkin_date',
        'checkout_date',
        'guests',

        // 📚 KURSUS
        'start_date',
        'end_date',
        'jam_kursus',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
