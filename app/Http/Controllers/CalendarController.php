<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    // FullCalendar用JSON API
    public function getEvents()
    {
        $events = \App\Models\Event::select('id', 'title', 'datetime', 'location')->get();

        $formatted = $events->map(function ($event) {
            return [
                'id' => $event->id,
                // タイトルに場所を付け足す（例：「会議 @ 本社」）
                'title' => $event->title . ($event->location ? ' @ ' . $event->location : ''),
                // ✅ datetime を FullCalendar の start にマッピング
                'start' => \Carbon\Carbon::parse($event->datetime)->toIso8601String(),
                // end がない場合は null でOK
                'end' => null,
                'url' => route('events.show', $event->id),
            ];
        });

        return response()->json($formatted);
    }

}
