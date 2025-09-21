<x-app-layout>
    <h1>イベント編集</h1>

    <form action="{{ route('events.update', $event) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" required>
        </div>

        <div>
            <label for="description">説明</label>
            <textarea name="description">{{ old('description', $event->description) }}</textarea>
        </div>

        <div>
            <label for="datetime">日時</label>
            <input type="datetime-local" name="datetime" 
                   value="{{ old('datetime', \Carbon\Carbon::parse($event->datetime)->format('Y-m-d\TH:i')) }}" 
                   required>
        </div>

        <div>
            <label for="location">場所</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}">
        </div>

        <button type="submit">更新</button>
    </form>
</x-app-layout>
