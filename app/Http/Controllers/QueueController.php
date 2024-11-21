<?php

namespace App\Http\Controllers;

use App\Models\SigningOffice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QueueController extends Controller
{
    public function index()
    {
        $signing_offices = SigningOffice::all();

        return Inertia::render('Queue', [
            'signing_offices' => $signing_offices->map(function ($signingOffice){
                return [
                    'office_id' => $signingOffice->office_id,
                    'office_name' => $signingOffice->office_name,
                    'signing_sequence' => $signingOffice->signing_sequence,
                    'is_active' => $signingOffice->isActive,
                ];
            })
        ]);
    }
}
