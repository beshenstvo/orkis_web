<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'Contract';
    protected $fillable = [
        'id',
        'date',
        'number_of_participants',
        'amount_in_currency',
        'Id_agreement',
    ];
}
