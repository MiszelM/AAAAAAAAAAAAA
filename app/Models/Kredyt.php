<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Kredyt extends Model
{
    use HasFactory;

    protected $fillable = [
        'klient_id', 'pracownik_id', 'credit_offer_id', 'wniosek_kredytowy_id',
        'data_zawarcia', 'numer_umowy', 'postanowienia_umowy', 'kwota_wydana',
        'kwota_odsetek', 'data_wydania', 'tytul_kredytu', 'termin_splaty',
        'liczba_rat', 'nr_rachunku_do_wplat', 'uwagi'
    ];

    public function klient() { return $this->belongsTo(Klient::class); }
    public function pracownik() { return $this->belongsTo(Pracownik::class); }
    public function oferta() { return $this->belongsTo(CreditOffer::class, 'credit_offer_id'); }
}