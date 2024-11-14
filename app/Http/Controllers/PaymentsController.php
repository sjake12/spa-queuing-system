<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentsController extends Controller
{
    public function index()
    {
        return Inertia::render('Index/Payments', [
            'payments' => Payments::all()->toArray(),
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
