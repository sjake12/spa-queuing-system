<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\ClearanceSigningOfficeStatus;
use App\Models\Event;
use App\Models\Payments;
use App\Models\SigningOffice;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClearanceController extends Controller
{
    public function index()
    {
        $isClearanceOnGoing = DB::table('settings')
            ->where('key', 'isClearanceOnGoing')
            ->first();
        $clearanceId = $isClearanceOnGoing->value ? auth()->user()->student->clearance->clearance_id : null;

        // query the clearance_signing_office_statuses to get the signing_office status
        $clearanceSigningOffices = ClearanceSigningOfficeStatus::where('clearance_id', $clearanceId)->get();

        return Inertia::render('Index/Clearance', [
            'signingOffices' => $clearanceSigningOffices->map(function ($clearanceSigningOffice) {
                return [
                    'office_id' => $clearanceSigningOffice->signingOffice->office_id,
                    'office_name' => $clearanceSigningOffice->signingOffice->office_name,
                    'is_active' => $clearanceSigningOffice->signingOffice->isActive,
                    'signing_sequence' => $clearanceSigningOffice->signingOffice->signing_sequence,
                    'is_approved' => $clearanceSigningOffice->is_approved,
                    'is_pending' => $clearanceSigningOffice->is_pending,
                ];
            }),

        ]);
    }

    public function show(SigningOffice $signingOffice)
    {
        // show signing office clearance requirement
        // event attendance
        $events = Event::where('signing_office', $signingOffice->office_id)->get();
        // fines
        $payments = Payments::where('office_id', $signingOffice->office_id)->get();
        // others
        $studentId = auth()->user()->username;

        return Inertia::render('Clearance/Show', [
            'signingOffice' => [
                'office_id' => $signingOffice->office_id,
                'office_name' => $signingOffice->office_name,
            ],
            'events' => $events,
            'payments' => $payments,
        ]);
    }

    public function start()
    {
        $students = Student::all();

        DB::table('settings')
            ->where('key', 'isClearanceOnGoing')
            ->update(['value' => true]);

        $students->map(function ($student) {
            $student->clearance()->create();
        });

        Event::processUnattendedEvents();
        Payments::registerRequirement();

        return redirect()->back()->with('success', 'Clearance has started');
    }

    public function end()
    {
        DB::table('settings')
            ->where('key', 'isClearanceOnGoing')
            ->update(['value' => false]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('clearances')->truncate();
        DB::table('clearance_signing_office_statuses')->truncate();
        DB::table('requirements')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'Clearance has ended');
    }
}
