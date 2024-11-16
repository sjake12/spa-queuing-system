<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClearanceController extends Controller
{
    public function index()
    {
        return Inertia::render('Index/Clearance');
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
