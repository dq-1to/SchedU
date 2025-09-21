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
        $messageData = null;
        $request = request();
        if ($request->has('message_id')) {
            $message = \App\Models\Message::find($request->message_id);
            if ($message) {
                $messageData = [
                    'title' => '予定: ' . $message->content,
                    'description' => $message->user->name . 'さんのメッセージから作成',
                    'datetime' => now()->format('Y-m-d H:i'), // とりあえず現在時刻
                    'location' => '',
                ];
            }
        }

        return view('events.create', compact('messageData'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'datetime' => 'required|date',
            'location' => 'nullable|string|max:255',
        ]);
    
        $request->user()->events()->create([
            'title' => $request->title,
            'description' => $request->description,
            'datetime' => $request->datetime,
            'location' => $request->location,
        ]);
    
        return redirect()->route('events.index')->with('success', 'イベントを作成しました！');
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


