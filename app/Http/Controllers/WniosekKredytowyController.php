<?php

namespace App\Http\Controllers;

class WniosekKredytowyController extends Controller
{
    public function index()
    {
        return view('wniosek_kredytowies.index');
    }
}