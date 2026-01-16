<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pracownik;

class PracownikController extends Controller
{
    /**
     * Wyświetla listę pracowników.
     */
    public function index()
    {
        return view('pracowniks.index');
    }

    /**
     * Opcjonalnie: Profil pracownika i jego statystyki bonusowe
     */
    public function show(Pracownik $pracownik)
    {
        return view('pracowniks.show', compact('pracownik'));
    }
}