<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SigningOffice;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $studentId = auth()->user() ? auth()->user()->username : null;

        return Inertia::render('Index/Events', [
            'events' => $events->map(function ($event) use ($studentId) {
                return [
                    'id' => $event->event_id,
                    'event_name' => $event->event_name,
                    'event_date' => $event->event_date,
                    'office' => SigningOffice::where('office_id', $event->signing_office)->first()->office_name,
                    'created_by' => Student::where('student_id', $event->created_by)->first(
                        )->first_name . ' ' . Student::where('student_id', $event->created_by)->first()->last_name,
                    'required' => $event->required,
                    'has_attended' => $event->eventAttendances->where('student_id', $studentId)->first()->attended,
                ];
            }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Events/Create');
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

        \request()->validate([
            'event_name' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'isRequired' => ['boolean'],
        ]);

        Event::factory()->create([
            'event_name' => \request()->event_name,
            'event_date' => \request()->event_date,
            'signing_office' => $offices[auth()->user()->student->rolesWithoutTeam->first()->name],
            'created_by' => auth()->user()->username,
            'required' => \request()->isRequired,
        ]);

        return redirect()->route('event');
    }
}
