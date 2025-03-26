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
        'number_of_seats',
        'seat_id',
        'seat_type'
    ];
}
