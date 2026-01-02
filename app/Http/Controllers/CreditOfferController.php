<?php

namespace App\Http\Controllers;

use App\Models\CreditOffer;

class CreditOfferController extends Controller
{
    public function index()
    {
        return view('credit_offers.index', [
            'offers' => CreditOffer::paginate(10),
        ]);
    }
}