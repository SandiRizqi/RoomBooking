<x-guest-page-layout>
    @php $title = 'Kalender Ketersediaan'; @endphp

    @push('styles')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <style>
        :root {
            --fc-border-color: #f3f4f6;
            --fc-daygrid-dot-prev-next-color: #9ca3af;
        }
        .fc {
            background: white;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .fc .fc-toolbar-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }
        .fc .fc-button-primary {
            background-color: #6366f1;
            border-color: #6366f1;
            border-radius: 0.75rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
        }
        .fc .fc-button-primary:hover {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        .fc .fc-button-primary:disabled {
            background-color: #9ca3af;
            border-color: #9ca3af;
        }
        .fc-day-today {
            background-color: #f5f3ff !important;
        }
        .fc-day-future {
            cursor: pointer;
        }
        .fc-day-future:hover {
            background-color: #f9fafb;
        }
        .fc-event {
            border-radius: 0.375rem;
            padding: 2px 4px;
            font-size: 0.75rem;
            font-weight: 500;
            border: none;
        }
    </style>
    @endpush

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 text-sm font-semibold rounded-full mb-4">Cek Ketersediaan</span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Kalender <span class="gradient-text">Jadwal Ruangan</span></h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">Klik pada tanggal yang tersedia untuk melihat ruangan apa saja yang bisa dipesan.</p>
        </div>

        <div id="calendar" class="min-h-[700px]"></div>

        <div class="mt-8 flex flex-wrap items-center gap-6 justify-center text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded text-red-500">.</div>
                <span>Ruangan Terpakai / Booked</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-white border border-gray-200 rounded text-white">.</div>
                <span>Tersedia / Klik untuk pesan</span>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                events: '/v1/availability-events',
                dateClick: function(info) {
                    // Cek jika tanggal yang diklik adalah hari ini atau masa depan
                    var clickedDate = new Date(info.dateStr);
                    var today = new Date();
                    today.setHours(0,0,0,0);

                    if (clickedDate >= today) {
                        window.location.href = '/rooms?date=' + info.dateStr;
                    }
                },
                eventClick: function(info) {
                    // Jika user klik event (ruang terpakai), arahkan ke detail ruang tsb
                    // Opsional: info.event.extendedProps.room_slug
                }
            });
            calendar.render();
        });
    </script>
    @endpush
</x-guest-page-layout>
