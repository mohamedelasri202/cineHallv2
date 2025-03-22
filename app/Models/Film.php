<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'image',
        'duree',
        'minimum_age',
        'trailer',
        'genre',
        'user_id'


    ];
}
