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
        $paymentStatus = PaymentStatus::where('student_id', auth()->user()->username)
            ->where('payments_id', $payments->id)
            ->first()
            ->is_paid;

        return Inertia::render('Payments/Show', [
            'payment' => [
                'payment_id' => $payments->id,
                'amount' => $payments->amount,
                'for' => $payments->for,
                'office' => SigningOffice::where('office_id', $payments->office_id)->first()->office_name,
                'deadline' => $payments->deadline,
                'type' => $payments->payment_type,
                'status' => $paymentStatus,
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Payments/Create');
    }

    public function store()
    {
        $offices = [
            'librarian' => 1,
            'psits' => 2,
            'ccso' => 3,
            'sbo' => 4,
            'program_head' => 5,
            'dean' => 6,
        ];
        // Validate the request
        \request()->validate([
            'amount' => ['required', 'string'],
            'for' => ['required', 'string'],
            'deadline' => ['required', 'date'],
        ]);

        // Create a new payment
        Payments::factory()->create([
            'amount' => \request()->amount,
            'for' => \request()->for,
            'office_id' => $offices[auth()->user()->student->rolesWithoutTeam->first()->name],
            'deadline' => \request()->deadline,
            'payment_type' => 'contribution',
        ]);

        // Redirect to the payments page
        return redirect()->route('payments');
    }

    public function pay(Payments $payments)
    {
        $paymentStatus = PaymentStatus::where('student_id', auth()->user()->username)
            ->where('payments_id', $payments->id)
            ->first();

        $paymentStatus->update([
            'is_paid' => true,
        ]);

        return redirect()->route('payments');
    }
}
