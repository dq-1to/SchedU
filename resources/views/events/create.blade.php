<x-app-layout>
    <h1>イベント作成</h1>

    <form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div>
        <label>タイトル</label>
        <input type="text" name="title" value="{{ $messageData['title'] ?? old('title') }}">
    </div>

    <div>
        <label>説明</label>
        <textarea name="description">{{ $messageData['description'] ?? old('description') }}</textarea>
    </div>

    <div>
        <label>日時</label>
        <input type="datetime-local" name="datetime" value="{{ $messageData['datetime'] ?? old('datetime') }}">
    </div>

    <div>
        <label>場所</label>
        <input type="text" name="location" value="{{ $messageData['location'] ?? old('location') }}">
    </div>

    <button type="submit">作成</button>
</form>

</x-app-layout>
