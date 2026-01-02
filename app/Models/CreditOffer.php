<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'interest_rate',
        'rrso',
        'min_credit_score',
        'worker_bonus',
    ];
}
