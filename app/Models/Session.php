<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = 'session';
    protected $fillable = [
        'film_id',
        'room',
        'start_time',
        'session_type',
        'languge',

    ];
}
