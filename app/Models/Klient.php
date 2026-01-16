<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klient extends Model
{
    /** @use HasFactory<\Database\Factories\KlientFactory> */
    use HasFactory;
    protected $fillable = [
    'imie', 'nazwisko', 'nazwa_firmy', 'ulica', 'nr_domu', 
    'nr_lokalu', 'miejscowosc', 'nr_telefonu', 'email'
];
}
