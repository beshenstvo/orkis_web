<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    protected $table = 'Hotels';
    protected $fillable = [
        'id',
        'name',
        'address',
        'type_category',
        'Id_city'
    ];
}
