<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'Organization';
    protected $fillable = [
        'id',
        'organization_name',
        'id_city',
    ];
}
