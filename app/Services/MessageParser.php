<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Message;

class MessageParser
{
    /**
     * チャットメッセージからイベント用データを抽出
     *
     * @param \App\Models\Message $message
     * @return array|null
     */
    public function parse(Message $message): ?array
    {
        // 初期値
        $title = $message->content;
        $datetime = now();
        $location = '';

        // メッセージ例: "9/25 14:00 開発打ち合わせ 本社"
        $pattern = '/(\d{1,2}\/\d{1,2})\s+(\d{1,2}:\d{2})\s+(.+)/';

        if (preg_match($pattern, $message->content, $matches)) {
            $date = $matches[1]; // 9/25
            $time = $matches[2]; // 14:00
            $rest = $matches[3]; // 開発打ち合わせ 本社

            $year = now()->year;
            $parsedDatetime = Carbon::createFromFormat('Y/m/d H:i', "$year/$date $time");

            // タイトル = 最初の単語
            $title = strtok($rest, ' ');

            // 場所 = タイトル以降の残り
            $location = trim(str_replace($title, '', $rest));

            $datetime = $parsedDatetime;
        }

        return [
            'title'       => $title,
            'description' => $message->user->name . 'さんのメッセージから作成',
            'datetime'    => $datetime->format('Y-m-d H:i'),
            'location'    => $location,
        ];
    }
}
