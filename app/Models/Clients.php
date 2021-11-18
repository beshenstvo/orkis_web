<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $table = 'Clients';
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'bth',
        'series_passport',
        'number_passport',
        'date_of_issue',
        'expiration_date',
        'government_agency',
        'place_of_birth',
        'type_sex',
        'type_client'
    ];
}
