<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'user_id',
        'price',
        'seat_id',
        'seat_type',
        'expires_at',
        'payment_id',
        'payment_status',
        'status',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at'
    ];
}

