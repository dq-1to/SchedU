<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カレンダー
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- ✅ FullCalendar の読み込みを先に -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    {{-- ↑ ここが大事。「main.min.js」ではなく「index.global.min.js」を使う！ --}}

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const el = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(el, {
            initialView: 'dayGridMonth',
            locale: 'ja',
            events: '{{ route('calendar.events') }}',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
        });
        calendar.render();
    });
    </script>

    <style>
        #calendar {
            background: white;
            padding: 10px;
            min-height: 600px;
        }
    </style>
</x-app-layout>
