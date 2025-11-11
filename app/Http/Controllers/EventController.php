<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Services\MessageParser;

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
                // Service を呼び出し
                $parser = new MessageParser();
                $messageData = $parser->parse($message);
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
            'chat_message_id' => 'nullable|exists:messages,id',
            'created_from_chat' => 'boolean',
        ]);

        $request->user()->events()->create([
            'title' => $request->title,
            'description' => $request->description,
            'datetime' => $request->datetime,
            'location' => $request->location,
            'chat_message_id' => $request->chat_message_id,
            'created_from_chat' => $request->created_from_chat ?? false,
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

    // カレンダーの詳細画面
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // カレンダーの新規作成画面
    public function createFromCalendar(Request $request)
    {
        $selectedDate = $request->query('date');
        return view('events.createFromCalendar', compact('selectedDate'));
    }

}


