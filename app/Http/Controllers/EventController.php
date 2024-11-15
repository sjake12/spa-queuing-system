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

        return Inertia::render('Index/Events', [
            'events' => $events->map(function ($event) {
                return [
                    'id' => $event->event_id,
                    'event_name' => $event->event_name,
                    'event_date' => $event->event_date,
                    'office' => SigningOffice::where('office_id', $event->signing_office)->first()->office_name,
                    'created_by' => Student::where('student_id', $event->created_by)->first()->first_name . ' ' . Student::where('student_id', $event->created_by)->first()->last_name,
                    'required' => $event->required,
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
        \request()->validate([
            'event_name' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'office' => ['required', 'string'],
            'isRequired' => ['boolean'],
        ]);

        Event::factory()->create([
            'event_name' => \request('event_name'),
            'event_date' => \request('event_date'),
            'office' => \request('office'),
            'created_by' => auth()->user()->student->first_name . ' ' . auth()->user()->student->last_name,
            'required' => \request('isRequired'),
        ]);

        return redirect()->route('event');
    }
}
