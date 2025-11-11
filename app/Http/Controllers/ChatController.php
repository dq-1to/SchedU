<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    // チャット一覧
    public function index()
    {
        // 最新順でメッセージを取得
        $messages = Message::with('user')->latest()->get();
        return view('chat.index', compact('messages'));
    }

    // メッセージ送信
    public function send(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $request->user()->messages()->create([
            'content' => $request->content,
            'is_event_candidate' => false,
        ]);

        return redirect()->route('chat.index');
    }
}
