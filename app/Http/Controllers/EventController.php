<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::with('user')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
        ]);

        $request->user()->events()->create($request->only('title','description','event_date'));

        return redirect()->route('events.index')->with('success','イベントを作成しました！');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'datetime' => 'required|date',
            'location' => 'nullable|string|max:255',
        ]);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'datetime' => $request->datetime,
            'location' => $request->location,
        ]);

        return redirect()->route('events.index')->with('success', 'イベントを更新しました！');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'イベントを削除しました！');
    }

}


