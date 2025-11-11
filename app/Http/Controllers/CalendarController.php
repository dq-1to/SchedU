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
        $events = Event::select('id', 'title', 'start', 'end', 'location')->get();

        // FullCalendarが認識しやすい形式に変換
        $formatted = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title . ' @ ' . $event->location,
                'start' => $event->start,
                'end'   => $event->end,
                'url'   => route('events.show', $event->id),
            ];
        });

        return response()->json($formatted);
    }
}

