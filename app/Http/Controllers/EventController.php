<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        return Event::latest()->paginate(10);
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
            'event_time' => ['required', 'string'],
            'isRequired' => ['boolean'],
        ]);

        Event::factory()->create([
            'event_name' => \request('event_name'),
            'event_date' => \request('event_date'),
            'event_time' => \request('event_time'),
            'required' => \request('isRequired'),
        ]);

        return redirect()->route('event');
    }
}
