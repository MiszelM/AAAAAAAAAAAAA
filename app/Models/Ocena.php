<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocena extends Model
{
    use HasFactory;

    protected $fillable = [
        'wniosek_kredytowy_id', 'data_oceny', 'dochody', 'okres_zatrudnienia',
        'liczba_osob', 'wydatki_stale', 'miesz_zobowiazania', 'reszta',
        'wynik_kredytowy', 'uwagi'
    ];

    public function wniosek()
    {
        return $this->belongsTo(WniosekKredytowy::class, 'wniosek_kredytowy_id');
    }
}