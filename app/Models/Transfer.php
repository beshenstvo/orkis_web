<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $table = 'Transfer';
    protected $fillable = [
        'id',
        'id_voucher',
        'model_of_transport',
        'departure',
        'arrival',
        'transfer'
    ];
}
