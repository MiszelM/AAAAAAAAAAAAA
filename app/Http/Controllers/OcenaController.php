<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcenaController extends Controller
{
  
    public function index()
    {
        return view('ocenas.index');
    }
}