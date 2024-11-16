<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\SigningOffice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentsController extends Controller
{
    public function index()
    {
        $payments =  Payments::all();

        return Inertia::render('Index/Payments', [
            'payments' => $payments->map(function ($payment) {
                return [
                    'id' => $payment->id,
                    'amount' => $payment->amount,
                    'for' => $payment->for,
                    'office' => SigningOffice::where('office_id', $payment->office_id)->first()->office_name,
                    'deadline' => $payment->deadline,
                ];
            }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Payments/Create');
    }

    public function store()
    {
        // Validate the request
        \request()->validate([
            'amount' => ['required', 'string'],
            'for' => ['required', 'string'],
            'office' => ['required', 'string'],
            'deadline' => ['required', 'date'],
        ]);

        // Create a new payment
        Payments::factory()->create([
            'amount' => \request('amount'),
            'for' => \request('for'),
            'office' => \request('office'),
            'deadline' => \request('deadline'),
        ]);

        // Redirect to the payments page
        return redirect()->route('payments');
    }
}
