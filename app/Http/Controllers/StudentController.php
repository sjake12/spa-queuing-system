<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all()->except(auth()->user()->student->student_id);

        return Inertia::render('Index/Students', [
            'students' => $students->toArray(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Students/Create');
    }

    public function store()
    {
        \request()->validate([
            'student_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'course' => 'required',
        ]);

        Student::create([
            'student_id' => \request('student_id'),
            'first_name' => \request('first_name'),
            'last_name' => \request('last_name'),
            'course' => \request('course'),
        ]);

        return redirect()->route('users');
    }

    public function edit(Student $student)
    {
        $roles = DB::table('roles')->get();

        return Inertia::render('Students/Edit', [
            'student' => $student->toArray(),
            'roles' => $roles->toArray(),
        ]);
    }

    public function update(Student $student)
    {
        \request()->validate([
            'student_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'course' => 'required',
        ]);

        $student->update([
            'student_id' => \request('student_id'),
            'first_name' => \request('first_name'),
            'last_name' => \request('last_name'),
            'course' => \request('course'),
        ]);

        return redirect()->route('users');
    }

    public function destroy(Student $student)
    {
        return Inertia::reload();
    }
}
