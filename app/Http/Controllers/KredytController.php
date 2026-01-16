<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KredytController extends Controller
{
    
    public function index()
    {
        return view('kredyts.index');
    }
}