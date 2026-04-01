<x-guest-page-layout>
    @php $title = 'Pilihan Glamping Premium'; @endphp

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-14 lg:py-20">

        <!-- Page Header -->
        <div class="mb-14">
            <div class="border-l-[3px] border-[#2d4a22] pl-5 mb-8">
                <span class="text-[9px] font-bold uppercase tracking-[0.3em] text-stone-400 block mb-3">Semua Unit</span>
                <h1 class="text-3xl sm:text-5xl font-bold text-stone-900 ff-serif leading-tight">
                    Pilih <span class="italic font-normal accent-bark">Pengalaman</span> Menginap
                </h1>
                <p class="text-stone-500 mt-3 font-light max-w-xl text-base">Temukan unit glamping yang paling sesuai dengan profil petualangan Anda.</p>
            </div>

            @if(isset($date))
            <div class="p-6 bg-green-50 border border-green-200 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-[#2d4a22] text-white rounded-xl flex items-center justify-center shadow-lg shadow-green-900/20 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-green-700 uppercase tracking-[0.25em] mb-1">Check-in Tersedia</p>
                        <p class="text-2xl font-bold text-stone-800 ff-serif italic">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
                <a href="{{ route('rooms.index') }}" class="self-start sm:self-center px-6 py-2.5 bg-white text-stone-600 font-bold rounded-xl border border-stone-200 hover:bg-stone-50 transition-all text-xs uppercase tracking-widest shadow-sm">
                    Ubah Tanggal
                </a>
            </div>
            @endif
        </div>

        <!-- Room Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
            @forelse($rooms as $room)
            <article class="bg-white rounded-2xl overflow-hidden border border-stone-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <!-- Image -->
                <div class="relative h-52 sm:h-56 bg-stone-100 overflow-hidden flex-shrink-0">
                    <!-- Placeholder selalu di belakang (z-0) -->
                    <div class="absolute inset-0 flex items-center justify-center z-0 bg-stone-50">
                        <svg class="w-12 h-12 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <!-- Gambar di atas placeholder (z-10) -->
                    @if($room->cover_image)
                        <img src="{{ Storage::url($room->cover_image) }}"
                             alt="{{ $room->name }}"
                             onerror="this.style.opacity='0'"
                             class="absolute inset-0 w-full h-full object-cover z-10 hover:scale-105 transition-transform duration-700">
                    @endif
                    <!-- Category Badge (z-20) -->
                    <div class="absolute top-4 left-4 z-20">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-[9px] font-bold text-stone-500 uppercase tracking-wider shadow-sm">
                            {{ $room->category ?? 'Nature Resort' }}
                        </span>
                    </div>
                    <!-- Price Badge (z-20) -->
                    <div class="absolute bottom-4 right-4 z-20">
                        <span class="px-3 py-1.5 bg-[#2d4a22] text-white rounded-lg text-xs font-bold shadow-lg">
                            {{ $room->formatted_price }}<span class="text-white/60 font-normal text-[9px]"> /mlm</span>
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 sm:p-6 flex flex-col flex-1">
                    <h3 class="text-[1.05rem] font-bold text-stone-900 ff-serif mb-2.5 leading-snug line-clamp-2">{{ $room->name }}</h3>

                    <!-- Capacity -->
                    <div class="flex items-center gap-1.5 text-stone-400 text-[11px] font-semibold mb-4">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Maks. {{ $room->capacity }} Tamu
                    </div>

                    <!-- Facilities -->
                    @if($room->facilities->count())
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        @foreach($room->facilities->take(3) as $facility)
                            <span class="inline-flex items-center px-2.5 py-1 bg-stone-50 text-stone-500 text-[9px] font-bold uppercase tracking-wider rounded-lg border border-stone-100">
                                {{ $facility->name }}
                            </span>
                        @endforeach
                        @if($room->facilities->count() > 3)
                            <span class="inline-flex items-center px-2.5 py-1 bg-stone-50 text-stone-400 text-[9px] font-bold rounded-lg border border-stone-100">
                                +{{ $room->facilities->count() - 3 }} lainnya
                            </span>
                        @endif
                    </div>
                    @endif

                    <div class="mt-auto">
                        <a href="{{ route('rooms.show', $room) }}" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 btn-nature font-bold rounded-xl text-sm">
                            Lihat Detail
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </article>

            @empty
            <div class="col-span-full py-24 text-center bg-white rounded-2xl border border-stone-100 border-dashed">
                <div class="w-20 h-20 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-stone-900 ff-serif italic mb-3">Belum Ada Tenda Tersedia</h3>
                <p class="text-stone-400 font-light max-w-sm mx-auto mb-8 text-sm">Maaf, tidak ada unit yang tersedia untuk kriteria saat ini.</p>
                <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 btn-nature rounded-xl font-bold text-sm">Semua Unit</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($rooms->hasPages())
        <div class="mt-14">
            {{ $rooms->links() }}
        </div>
        @endif
    </div>
</x-guest-page-layout>
