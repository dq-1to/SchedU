<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- 左カラム: チャットルーム -->
        <div>
            <h2 class="text-xl font-bold mb-4">チャットルーム</h2>
            <div class="chat-box border p-4 rounded bg-white shadow">
                @foreach ($messages as $message)
                    <p class="mb-2">
                        <strong>{{ $message->user->name }}:</strong>
                        {{ $message->content }}
                        <small class="text-gray-500">({{ $message->created_at->format('H:i') }})</small>
                    </p>
                @endforeach
            </div>
            <!-- 送信フォーム -->
            <form action="{{ route('chat.send') }}" method="POST" class="mt-4 flex">
                @csrf
                <input 
                    type="text" 
                    name="content" 
                    placeholder="9/25 14:00 開発打ち合わせ 本社" 
                    class="flex-1 border rounded-l px-3 py-2"
                >
                <button type="submit" class="bg-blue-500 text-white px-4 rounded-r">送信</button>
            </form>
        </div>

        <!-- 右カラム: メッセージ一覧 -->
        <div>
            <h2 class="text-xl font-bold mb-4 flex items-center justify-between">
                メッセージ一覧
                <button id="toggleMessages" class="text-sm bg-gray-200 px-2 py-1 rounded">表示/非表示</button>
            </h2>
            <div id="messagesList" class="border p-4 rounded bg-white shadow">
                @foreach ($messages as $message)
                    <p class="mb-2">
                        <strong>{{ $message->user->name }}:</strong>
                        {{ $message->content }}
                        <a href="{{ route('events.create', ['message_id' => $message->id]) }}" class="text-blue-500 hover:underline">
                            予定にする
                        </a>
                    </p>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('toggleMessages').addEventListener('click', function () {
            const list = document.getElementById('messagesList');
            list.style.display = (list.style.display === 'none') ? 'block' : 'none';
        });
    </script>
    @endpush
</x-app-layout>
