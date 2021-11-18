<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'Employees';
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'bth',
        'photo',
        'id_organization',
        'type_position'
    ];
}
