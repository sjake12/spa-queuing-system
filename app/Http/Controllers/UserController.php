<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAttendance;
use App\Models\PaymentStatus;
use App\Models\Queue;
use App\Models\SigningOffice;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $signingOffice = Queue::where('student_id', $request->user()->student->student_id)
            ->where('status', 'pending')
            ->first()
            ->signingOffice;
        $activeOffices = SigningOffice::where('isActive', true)->count();
        $numberOfPayments = PaymentStatus::where('student_id', $request->user()->student->student_id)->count();
        $numberOfPaidPayments = PaymentStatus::where('student_id', $request->user()->student->student_id)
            ->where('is_paid', true)
            ->count();
        $numberOfEvents = Event::all()->count();
        $numberOfAttendedEvents = EventAttendance::where('student_id', $request->user()->student->student_id)
            ->where('attended', true)
            ->count();

        return Inertia::render('Dashboard', [
            'queueUpdate' => [
                'signingOffice' => [
                    'id' => $signingOffice->office_id,
                    'name' => $signingOffice->office_name,
                    'signingOrder' => $signingOffice->signing_sequence,
                ],
                'activeOffices' => $activeOffices,
            ],
            'paymentStatus' => [
                'numberOfPayments' => $numberOfPayments,
                'numberOfPaidPayments' => $numberOfPaidPayments,
            ],
            'eventAttendance' => [
                'numberOfEvents' => $numberOfEvents,
                'numberOfAttendedEvents' => $numberOfAttendedEvents,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
