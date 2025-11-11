<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            イベント詳細
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <h3 class="text-2xl font-semibold mb-4">{{ $event->title }}</h3>

            <p class="text-gray-700 mb-2">
                日時：{{ \Carbon\Carbon::parse($event->datetime)->format('Y年m月d日 H:i') }}
            </p>

            @if($event->location)
                <p class="text-gray-700 mb-2">場所：{{ $event->location }}</p>
            @endif

            @if($event->description)
                <p class="text-gray-700 mb-4">詳細：{{ $event->description }}</p>
            @endif

            <div class="flex gap-3 mt-4">
                <a href="{{ route('events.edit', $event->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">編集</a>
                <a href="{{ route('calendar.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">戻る</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">削除</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
