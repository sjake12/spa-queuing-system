<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\PaymentStatus;
use App\Models\SigningOffice;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PaymentsController extends Controller
{
    public function index()
    {
        $studentId = auth()->user()->username;
        $filteredPaymentStatuses= PaymentStatus::where('student_id', $studentId)->get();

        return Inertia::render('Index/Payments', [
            'payments' => $filteredPaymentStatuses->map(function ($paymentStatus) {
                return [
                    'id' => $paymentStatus->payments_id,
                    'amount' => $paymentStatus->payments->amount,
                    'for' => $paymentStatus->payments->for,
                    'office' => SigningOffice::where('office_id', $paymentStatus->payments->office_id)->first()->office_name,
                    'deadline' => $paymentStatus->payments->deadline,
                    'status' => $paymentStatus->is_paid,
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
