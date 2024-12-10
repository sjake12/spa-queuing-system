<?php

namespace App\Http\Controllers;

use App\Models\ClearanceSigningOfficeStatus;
use App\Models\Event;
use App\Models\Payments;
use App\Models\PaymentStatus;
use App\Models\Requirement;
use App\Models\SigningOffice;
use App\Models\Student;
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
        $requirements = Payments::where('office_id', $signingOffice->office_id)->get();

        return Inertia::render('Clearance/Show', [
            'requirements' => $requirements->map(function ($requirement) {
                return [
                    'requirement_id' => $requirement->id,
                    'requirement_name' => $requirement->for,
                    'requirement_type' => $requirement->payment_type,
                    'amount' => $requirement->amount,
                    'is_paid' => $requirement->paymentStatus->where('student_id', auth()->user()->student->student_id)->first()->is_paid,
                ];
            }),
            'office_name' =>  $signingOffice->office_name,
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

    public function updateClearanceSigningOfficeStatus()
    {
        // Get all clearance signing office statuses
        $clearanceSigningOfficeStatuses = ClearanceSigningOfficeStatus::all();

        foreach ($clearanceSigningOfficeStatuses as $status) {
            // Check if there are any requirements for this status's signing office and clearance
            $hasRequirements = Requirement::where('office_id', $status->signing_office_id)
                ->exists();

            // If no requirements exist, set is_pending to false
            if (!$hasRequirements) {
                $status->is_pending = false;
                $status->save();
            }
        }
    }
}
