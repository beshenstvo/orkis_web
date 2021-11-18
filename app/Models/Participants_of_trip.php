<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants_of_trip extends Model
{
    use HasFactory;
    protected $table = 'Participants_of_trip';
    protected $fillable = [
        'id',
        'name',
        'surname',
        'patronymic',
        'bth',
        'id_contract',
        'id_voucher'
    ];
}
