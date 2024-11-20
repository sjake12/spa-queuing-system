<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\ClearanceSigningOfficeStatus;
use App\Models\SigningOffice;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClearanceController extends Controller
{
    public function index()
    {
        $signingOffices = SigningOffice::all();
        $isClearanceOnGoing = DB::table('settings')
            ->where('key', 'isClearanceOnGoing')
            ->first();
        $clearanceId = $isClearanceOnGoing->value ? auth()->user()->student->clearance->clearance_id : null;

        // query the clearance_signing_office_statuses to get the signing_office status
        $clearanceSigningOffices = ClearanceSigningOfficeStatus::where('clearance_id', $clearanceId)->get();

        return Inertia::render('Index/Clearance', [
            'signingOffices' => $clearanceSigningOffices->map(function ($clearanceSigningOffice) {
               return [
                   'office_name' => $clearanceSigningOffice->signingOffice->office_name,
                   'is_active' => $clearanceSigningOffice->signingOffice->isActive,
                   'is_approved' => $clearanceSigningOffice->is_approved,
                   'is_pending' => $clearanceSigningOffice->is_pending,
               ];
            }),

        ]);
    }

    public function show()
    {
        $studentId = auth()->user()->username;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'Clearance has ended');
    }
}
