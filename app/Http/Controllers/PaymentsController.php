<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\PaymentStatus;
use App\Models\SigningOffice;
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
                    'status' => PaymentStatus::where('payments_id', $payment->id)->first()->status,
                ];
            }),
        ]);
    }

    public function show(Payments $payments)
    {
        return Inertia::render('Payments/Show', [
            'payment' => [
                'amount' => $payments->amount,
                'for' => $payments->for,
                'office' => SigningOffice::where('office_id', $payments->office_id)->first()->office_name,
                'deadline' => $payments->deadline,
                'type' => $payments->payment_type,
            ],
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
