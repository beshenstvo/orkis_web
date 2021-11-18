<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number_of_cities_visited extends Model
{
    use HasFactory;
    protected $table = 'Number_of_cities_visited';
    protected $fillable = [
        'id',
        'id_city',
        'id_agreement',
    ];
}
