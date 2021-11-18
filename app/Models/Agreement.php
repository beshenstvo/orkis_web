<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;
    protected $table = 'Agreement';
    protected $fillable = [
        'id',
        'date',
        'number_of_participants',
        'start_of_trip',
        'end_of_trip',
        'Id_organization',
        'Id_agent',
        'Id_client',
        'Id_agent',
        'Id_employee',
    ];
}
