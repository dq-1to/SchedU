<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Message;
use App\Models\Event;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Tinkerで作った最初のユーザーを取得
        $user = User::first();

        if (!$user) {
            $this->command->warn('ユーザーが見つかりません。先にユーザーを作成してください。');
            return;
        }

        // チャットメッセージ5件
        for ($i = 1; $i <= 5; $i++) {
            Message::create([
                'user_id' => $user->id,
                'content' => "テストメッセージ {$i}",
                'is_event_candidate' => $i % 2 === 0,
            ]);
        }

        // イベント5件
        for ($i = 1; $i <= 5; $i++) {
            Event::create([
                'user_id' => $user->id,
                'title' => "テストイベント {$i}",
                'description' => "これはテストイベント {$i} の詳細です。",
                'datetime' => now()->addDays($i)->setTime(14, 0, 0),
                'location' => "会議室{$i}",
                'created_from_chat' => $i % 2 === 1,
                'chat_message_id' => null,
            ]);
        }
    }
}
