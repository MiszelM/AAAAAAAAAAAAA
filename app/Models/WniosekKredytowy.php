<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WniosekKredytowy extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'klient_id', 'pracownik_id', 'credit_offer_id', 
        'data_zlozenia', 'data_rozpatrzenia', 'wnioskowana_kwota', 'uwagi'
    ];

    public function klient() {
        return $this->belongsTo(Klient::class);
    }

    public function pracownik() {
        return $this->belongsTo(Pracownik::class);
    }

    public function oferta() {
        return $this->belongsTo(CreditOffer::class, 'credit_offer_id');
    }
}