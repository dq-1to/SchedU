<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">チャットルーム</h2>

        <!-- メッセージ一覧 -->
        <div class="border rounded p-3 mb-4" style="height: 300px; overflow-y: auto;">
            @foreach($messages as $message)
                <p>
                    <strong>{{ $message->user->name }}:</strong>
                    {{ $message->content }}
                    <small class="text-muted">({{ $message->created_at->format('H:i') }})</small>
                </p>
            @endforeach
        </div>

        <!-- 送信フォーム -->
        <form action="{{ route('chat.send') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="content" class="form-control" placeholder="メッセージを入力..." required>
                <button type="submit" class="btn btn-primary">送信</button>
            </div>
        </form>
    </div>
</x-app-layout>
