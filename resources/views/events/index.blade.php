<x-app-layout>
    <h1>イベント一覧</h1>

    <a href="{{ route('events.create') }}">新規イベント作成</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @forelse ($events as $event)
        <div>
            <strong>{{ $event->title }}</strong>
            （{{ $event->datetime }} @ {{ $event->location }}）
            <br>
            {{ $event->description }}

            <a href="{{ route('events.edit', $event) }}">編集</a>

            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    @empty
        <p>イベントはまだありません</p>
    @endforelse
</x-app-layout>
