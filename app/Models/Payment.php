<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'Payment';
    protected $fillable = [
        'date_of_payment',
        'amount_in_rubels',
        'id_contract',
        'id_employee',
    ];
}
