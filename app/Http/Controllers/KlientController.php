<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klient;

class KlientController extends Controller
{
    /**
     * Wyświetla listę klientów.
     */
    public function index()
    {
        return view('klients.index');
    }
    
}