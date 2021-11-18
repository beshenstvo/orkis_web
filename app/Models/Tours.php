<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    use HasFactory;
    protected $table = 'Tours';
    protected $fillable = [
        'id',
        'type_room',
        'type_food',
        'id_hotel',
        'id_voucher',
        'id_route'
    ];
}
