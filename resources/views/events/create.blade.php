<x-app-layout>
    <h1>イベント作成</h1>

    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <div>
            <label>タイトル</label>
            <input type="text" name="title" value="{{ old('title', $messageData['title'] ?? '') }}">
        </div>

        <div>
            <label>説明</label>
            <textarea name="description">{{ old('description', $messageData['description'] ?? '') }}</textarea>
        </div>

        <div>
            <label>日時</label>
            <input type="datetime-local" name="datetime" 
                   value="{{ old('datetime', isset($messageData['datetime']) ? \Carbon\Carbon::parse($messageData['datetime'])->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div>
            <label>場所</label>
            <input type="text" name="location" value="{{ old('location', $messageData['location'] ?? '') }}">
        </div>

        <button type="submit">作成</button>
    </form>
</x-app-layout>
