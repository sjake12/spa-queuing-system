<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ClearanceController extends Controller
{
    public function index()
    {
        return Inertia::render('Index/Clearance');
    }

    public function start()
    {
        DB::table('settings')
            ->where('key', 'isClearanceOnGoing')
            ->update(['value' => true]);

        return redirect()->back()->with('success', 'Clearance has started');
    }

    public function end()
    {
        DB::table('settings')
            ->where('key', 'isClearanceOnGoing')
            ->update(['value' => false]);

        return redirect()->back()->with('success', 'Clearance has ended');
    }
}
