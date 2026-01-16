<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pracownik extends Model
{
    use HasFactory;

    protected $fillable = [
        'imie', 'nazwisko', 'email', 'nr_telefonu', 'wynik_bonusu', 'stanowisko'
    ];

    // Reguły walidacji pasujące do Twoich ograniczeń SQL
    public static function rules()
    {
        return [
            'pracownik.imie' => 'required|string|max:20',
            'pracownik.nazwisko' => 'required|string|max:20',
            'pracownik.email' => 'required|email|max:50',
            'pracownik.nr_telefonu' => ['required', 'regex:/^\+\d{2} \d{3} \d{3} \d{3}$/'],
            'pracownik.wynik_bonusu' => 'required|integer|min:0',
            'pracownik.stanowisko' => 'required|string|max:20',
        ];
    }
}
