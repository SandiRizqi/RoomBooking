<x-guest-page-layout>
    @push('styles')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <style>
        /* ===== FullCalendar — Glampify Theme ===== */
        .fc {
            font-family: 'DM Sans', sans-serif;
        }
        .fc .fc-toolbar {
            padding: 1.25rem 1.5rem 0.75rem;
            align-items: center;
        }
        .fc .fc-toolbar-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1c1917;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
        }
        .fc .fc-button-group { gap: 4px; }
        .fc .fc-button-primary {
            background-color: #2d4a22;
            border-color: #2d4a22;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.72rem;
            padding: 5px 12px;
            letter-spacing: 0.04em;
            box-shadow: none;
            outline: none;
        }
        .fc .fc-button-primary:hover,
        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background-color: #1a2d13;
            border-color: #1a2d13;
            box-shadow: none;
        }
        .fc .fc-button-primary:focus { box-shadow: 0 0 0 2px rgba(45,74,34,0.25); }
        .fc-day-today { background-color: #f0fdf4 !important; }
        .fc-day-past  { opacity: 0.55; }
        .fc-day-future { cursor: pointer; }
        .fc-day-future:hover { background-color: #f8fdf7 !important; }
        .fc .fc-daygrid-day-number {
            font-size: 0.75rem;
            font-weight: 600;
            color: #78716c;
            padding: 6px 8px;
        }
        .fc .fc-col-header-cell-cushion {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #a8a29e;
            padding: 10px 0 8px;
        }
        .fc-event {
            border-radius: 5px !important;
            padding: 1px 6px !important;
            font-size: 0.67rem !important;
            font-weight: 700 !important;
            border: none !important;
            cursor: pointer;
        }
        .fc .fc-daygrid-day-frame { min-height: 72px; }
        .fc-theme-standard td,
        .fc-theme-standard th,
        .fc-theme-standard .fc-scrollgrid { border-color: #f3f4f4; }
        .fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events { min-height: 2em; }
        @media (max-width: 640px) {
            .fc .fc-toolbar { flex-direction: column; gap: 8px; align-items: flex-start; padding: 1rem 1rem 0.5rem; }
            .fc .fc-toolbar-title { font-size: 0.95rem; }
            .fc .fc-daygrid-day-frame { min-height: 52px; }
            .fc-event { font-size: 0.6rem !important; }
        }
    </style>
    @endpush

    {{-- ======================================================
         HERO
    ====================================================== --}}
    <section class="relative min-h-[88vh] flex items-center overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-stone-800">
            <img src="{{ asset('assets/nature_glam.jpg') }}"
                 alt="Glampify Resort"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
        </div>

        {{-- Content --}}
        <div class="relative z-10 w-full max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-24 sm:py-32">
            <div class="max-w-2xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 border border-white/25 backdrop-blur-sm rounded-full text-[10px] font-bold uppercase tracking-[0.18em] mb-7 text-white/65">
                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                    Est. 2026 • Glampify Resort
                </div>
                {{-- Headline --}}
                <h1 class="text-4xl sm:text-5xl lg:text-[3.75rem] font-bold ff-serif leading-[1.1] mb-6 text-white">
                    Harmoni Alam,<br>
                    <span class="italic font-light text-stone-300">Kemewahan Tak Terbatas.</span>
                </h1>
                {{-- Sub --}}
                <p class="text-base sm:text-lg text-white/70 mb-10 leading-relaxed font-light max-w-xl">
                    Lepaskan penat dan rasakan sensasi menginap di tenda eksklusif dengan panorama hutan pinus yang menenangkan jiwa.
                </p>
                {{-- CTA --}}
                <div class="flex flex-wrap gap-3 sm:gap-4">
                    <a href="#rooms"
                       class="inline-flex items-center gap-2.5 px-6 py-3 btn-nature font-bold rounded-xl shadow-lg shadow-green-950/30 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        Pesan Sekarang
                    </a>
                    <a href="#availability"
                       class="inline-flex items-center gap-2.5 px-6 py-3 bg-white/10 hover:bg-white/18 backdrop-blur-sm border border-white/25 text-white font-bold rounded-xl transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Cek Ketersediaan
                    </a>
                </div>
            </div>
        </div>

        {{-- Scroll hint --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-white/35">
            <span class="text-[8px] font-bold uppercase tracking-[0.35em]">Scroll</span>
            <div class="w-px h-10 bg-gradient-to-b from-white/35 to-transparent"></div>
        </div>
    </section>

    {{-- ======================================================
         STATS BAR
    ====================================================== --}}
    <div class="bg-white border-b border-stone-100 py-4">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-stone-100">
                @foreach([['12+','Unit Tenda'],['4.9','Guest Rating'],['100%','Organic Food'],['24h','Premium Service']] as [$val,$lbl])
                <div class="py-7 lg:py-9 px-4 lg:px-8 text-center">
                    <div class="text-3xl lg:text-[2.25rem] font-bold text-[#2d4a22] ff-serif leading-none mb-1.5">{{ $val }}</div>
                    <div class="text-[9px] text-stone-400 uppercase tracking-[0.22em] font-bold">{{ $lbl }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ======================================================
         AVAILABILITY CALENDAR
    ====================================================== --}}
    <section id="availability" class="py-20 sm:py-24 bg-[#f5f0e8]">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

            {{-- Header --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start mb-10">
                <div>
                    <span class="section-label">Ketersediaan Unit</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-[2.75rem] font-bold text-stone-900 ff-serif leading-tight mb-4">
                        Cek <span class="italic font-light accent-bark">Jadwal</span><br>Ketersediaan
                    </h2>
                    <p class="text-stone-500 leading-relaxed text-sm font-light">
                        Klik tanggal atau event di kalender untuk melihat unit yang bisa Anda pesan. Hijau berarti ada unit kosong, merah berarti terpakai.
                    </p>
                </div>

                {{-- Legend --}}
                <!-- <div class="flex flex-wrap gap-2 lg:justify-end lg:pt-10">
                    <div class="flex items-center gap-2 bg-white rounded-lg px-4 py-2 shadow-sm border border-stone-100">
                        <span class="w-2 h-3 rounded-[3px] bg-[#2d4a22] flex-shrink-0"></span>
                        <span class="text-[11px] font-semibold text-stone-600">Unit Tersedia</span>
                    </div>
                    <div class="flex items-center gap-2.5 bg-white rounded-lg px-4 py-2 shadow-sm border border-stone-100">
                        <span class="w-2.5 h-2.5 rounded-[3px] bg-red-500 flex-shrink-0"></span>
                        <span class="text-[11px] font-semibold text-stone-600">Unit Terpakai</span>
                    </div>
                    <div class="flex items-center gap-2.5 bg-white rounded-lg px-4 py-2 shadow-sm border border-stone-100">
                        <span class="w-2.5 h-2.5 rounded-[3px] bg-green-100 border border-green-400 flex-shrink-0"></span>
                        <span class="text-[11px] font-semibold text-stone-600">Hari Ini</span>
                    </div>
                </div> -->
            </div>

            {{-- Calendar card --}}
            <div class="bg-white rounded-2xl shadow-[0_4px_32px_-8px_rgba(0,0,0,0.1)] border border-stone-100 overflow-hidden">
                <div id="home-calendar"></div>
            </div>
        </div>
    </section>

    {{-- ======================================================
         ROOMS SECTION
    ====================================================== --}}
    <section id="rooms" class="py-20 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-12">
                <div class="border-l-[3px] border-[#2d4a22] pl-5">
                    <span class="text-[9px] font-bold uppercase tracking-[0.28em] text-stone-400 block mb-2">Pilihan Unit</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-[2.5rem] font-bold text-stone-900 ff-serif leading-tight">
                        Pilih <span class="italic font-light accent-bark">Peristirahatan</span> Anda
                    </h2>
                    <p class="text-stone-400 mt-2.5 text-sm font-light">Setiap tenda dirancang khusus untuk kenyamanan Anda menyatu dengan alam.</p>
                </div>
                <a href="{{ route('rooms.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-1 border border-stone-200 rounded-full font-bold text-stone-500 hover:bg-[#2d4a22] hover:text-white hover:border-[#2d4a22] transition-all text-[11px] uppercase tracking-widest shrink-0">
                    Lihat Semua
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Room Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-6">
                @foreach($rooms as $room)
                <article class="bg-white rounded-2xl overflow-hidden border border-stone-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                    {{-- Image --}}
                    <div class="relative h-56 bg-stone-50 overflow-hidden flex-shrink-0">
                        {{-- Placeholder selalu di belakang (z-0) --}}
                        <div class="absolute inset-0 flex items-center justify-center z-0 pointer-events-none">
                            <svg class="w-10 h-10 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        {{-- Gambar di atas placeholder (z-10) --}}
                        @if($room->cover_image)
                            <img src="{{ Storage::url($room->cover_image) }}"
                                 alt="{{ $room->name }}"
                                 onerror="this.style.opacity='0'"
                                 class="absolute inset-0 w-full h-full object-cover z-10 group-hover:scale-105 transition-transform duration-700">
                        @endif
                        {{-- Category Badge (z-20) --}}
                        <div class="absolute top-3 left-3 z-20">
                            <span class="px-2.5 py-1 bg-white/90 backdrop-blur-sm rounded-md text-[9px] font-bold text-stone-500 uppercase tracking-wide shadow-sm">
                                {{ $room->category ?? 'Nature Glamping' }}
                            </span>
                        </div>
                        {{-- Price Badge (z-20) --}}
                        <div class="absolute bottom-3 right-3 z-20">
                            <span class="px-3 py-1.5 bg-[#2d4a22] text-white rounded-lg text-[11px] font-bold shadow-md">
                                {{ $room->formatted_price }}<span class="text-white/55 font-normal text-[9px]"> /mlm</span>
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5 sm:p-6 flex flex-col flex-1">
                        <h3 class="text-[1.05rem] font-bold text-stone-900 ff-serif mb-2.5 leading-snug line-clamp-2">{{ $room->name }}</h3>

                        {{-- Capacity --}}
                        <div class="flex items-center gap-1.5 text-stone-400 text-[11px] font-semibold mb-4">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Maks. {{ $room->capacity }} Tamu
                        </div>

                        {{-- Facilities --}}
                        @if($room->facilities->count())
                        <div class="flex flex-wrap gap-1 mb-5">
                            @foreach($room->facilities->take(3) as $facility)
                                <span class="px-2 py-1 bg-stone-50 text-stone-500 text-[9px] font-bold uppercase tracking-wide rounded-md border border-stone-100">
                                    {{ $facility->name }}
                                </span>
                            @endforeach
                            @if($room->facilities->count() > 3)
                                <span class="px-2 py-1 bg-stone-50 text-stone-400 text-[9px] font-bold rounded-md border border-stone-100">
                                    +{{ $room->facilities->count() - 3 }}
                                </span>
                            @endif
                        </div>
                        @endif

                        <div class="mt-auto pt-1">
                            <a href="{{ route('rooms.show', $room) }}"
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 btn-nature font-bold rounded-xl text-sm">
                                Lihat Detail
                                <svg class="w-3 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======================================================
         GALLERY SECTION
    ====================================================== --}}
    <section id="gallery" class="py-20 sm:py-24 bg-[#f5f0e8]">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            {{-- Header --}}
            <div class="text-center mb-12">
                <span class="text-[9px] font-bold uppercase tracking-[0.28em] text-stone-400 block mb-3">Galeri Resort</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-stone-900 ff-serif italic mb-4">Album Kenangan</h2>
                <div class="w-12 h-0.5 bg-[#2d4a22] mx-auto rounded-full"></div>
            </div>

            @if($galleries->count())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($galleries as $index => $gallery)
                <div class="relative group rounded-xl sm:rounded-2xl overflow-hidden bg-stone-200
                    {{ $index === 0 ? 'col-span-2 row-span-2' : '' }}"
                    style="{{ $index === 0 ? 'min-height:320px;' : 'height:180px;' }}">
                    {{-- Placeholder selalu di belakang (z-0) --}}
                    <div class="absolute inset-0 flex items-center justify-center z-0 bg-stone-100">
                        <svg class="w-8 h-8 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    {{-- Gambar di atas placeholder (z-10); ketika error menjadi transparan --}}
                    <img src="{{ Storage::url($gallery->image_path) }}"
                         alt="{{ $gallery->title }}"
                         onerror="this.style.opacity='0'"
                         class="absolute inset-0 w-full h-full object-cover z-10 group-hover:scale-105 transition-transform duration-700">
                    {{-- Hover overlay di atas gambar (z-20) --}}
                    <div class="absolute inset-0 bg-[#2d4a22]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center text-white p-4 text-center z-20">
                        <p class="text-[8px] font-bold uppercase tracking-widest mb-1.5 text-white/55">Glampify Moments</p>
                        <p class="text-sm ff-serif font-bold italic leading-snug">{{ $gallery->title }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- ======================================================
         NEWS SECTION
    ====================================================== --}}
    <section class="py-20 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-[9px] font-bold uppercase tracking-[0.28em] text-stone-400 block mb-2">Berita & Informasi</span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-stone-900 ff-serif italic accent-bark">Terbaru</h2>
                </div>
                <a href="{{ route('news.index') }}"
                   class="text-[11px] font-bold text-[#2d4a22] hover:underline underline-offset-4 shrink-0 flex items-center gap-1.5">
                    Semua Artikel
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
                @foreach($news as $item)
                <a href="{{ route('news.show', $item) }}"
                   class="group block bg-white rounded-2xl border border-stone-100 overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    {{-- Image --}}
                    <div class="aspect-[16/9] overflow-hidden bg-stone-50 relative flex items-center justify-center">
                        @if($item->image_path)
                            <img src="{{ Storage::url($item->image_path) }}"
                                alt="{{ $item->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="flex flex-col items-center justify-center text-stone-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif

                    </div>
                    {{-- Content --}}
                    <div class="p-4">
                        <div class="flex items-center gap-2 text-[9px] font-bold text-[#2d4a22] uppercase tracking-[0.22em] mb-2">
                            <div class="w-1 h-3 bg-[#2d4a22] rounded-full"></div>
                            {{ $item->published_at->format('d M Y') }}
                        </div>
                        <h3 class="text-base font-bold text-stone-900 leading-snug ff-serif group-hover:text-[#2d4a22] transition-colors line-clamp-2">
                            {{ $item->title }}
                        </h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======================================================
         FOOTER
    ====================================================== --}}
    <footer class="bg-[#1a2d13] text-stone-400">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-16 pb-10">
            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12 pb-12 border-b border-white/10">
                {{-- Brand --}}
                <div class="sm:col-span-2 lg:col-span-1">
                    <h3 class="text-white text-2xl font-bold ff-serif italic mb-4">Glampify.</h3>
                    <p class="text-sm leading-relaxed text-stone-500 font-light mb-6 max-w-xs">
                        Menghubungkan kemewahan modern dengan harmoni alam pegunungan untuk istirahat terbaik Anda.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 bg-white/8 hover:bg-white/15 rounded-xl flex items-center justify-center transition-colors border border-white/10">
                            <svg class="w-4 h-4 text-stone-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/8 hover:bg-white/15 rounded-xl flex items-center justify-center transition-colors border border-white/10">
                            <svg class="w-4 h-4 text-stone-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white text-[9px] font-bold mb-6 uppercase tracking-[0.28em]">Resort Unit</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('rooms.index') }}" class="text-[11px] font-medium text-stone-500 hover:text-stone-300 transition-colors">Tenda Premium</a></li>
                        <li><a href="{{ route('rooms.index') }}" class="text-[11px] font-medium text-stone-500 hover:text-stone-300 transition-colors">Unit Keluarga</a></li>
                        <li><a href="{{ route('rooms.index') }}" class="text-[11px] font-medium text-stone-500 hover:text-stone-300 transition-colors">Boutique Cabin</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white text-[9px] font-bold mb-6 uppercase tracking-[0.28em]">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="#availability" class="text-[11px] font-medium text-stone-500 hover:text-stone-300 transition-colors">Cek Ketersediaan</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-[11px] font-medium text-stone-500 hover:text-stone-300 transition-colors">Berita Resort</a></li>
                        <li><a href="{{ route('login') }}" class="text-[11px] font-medium text-stone-500 hover:text-stone-300 transition-colors">Area Member</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white text-[9px] font-bold mb-6 uppercase tracking-[0.28em]">Kontak Kami</h4>
                    <address class="not-italic text-[11px] text-stone-500 leading-relaxed font-light">
                        Glampify Ridge, Pine Hill No. 7<br>
                        Kawasan Hutan Lindung, Indonesia
                    </address>
                    <a href="tel:+6281234567890" class="block mt-4 text-sm text-white font-semibold hover:text-stone-300 transition-colors">
                        +62 812 3456 7890
                    </a>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="flex flex-col sm:flex-row justify-between items-center gap-3 text-[9px] text-stone-600 tracking-[0.25em] font-bold uppercase">
                <p>&copy; {{ date('Y') }} Glampify Luxury Resort. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-stone-400 transition-colors">Privasi</a>
                    <a href="#" class="hover:text-stone-400 transition-colors">Syarat</a>
                </div>
            </div>
        </div>
    </footer>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calEl = document.getElementById('home-calendar');
            if (!calEl) return;

            var calendar = new FullCalendar.Calendar(calEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                // event booked (merah) tampil duluan karena lebih prioritas secara visual
                eventOrder: function(a, b) {
                    var typeA = (a.extendedProps && a.extendedProps.type) || '';
                    var typeB = (b.extendedProps && b.extendedProps.type) || '';
                    if (typeA === 'booked' && typeB !== 'booked') return -1;
                    if (typeA !== 'booked' && typeB === 'booked') return 1;
                    return 0;
                },
                events: '/api/availability-events',
                eventClick: function (info) {
                    var props = info.event.extendedProps || {};
                    if (props.type === 'available' && props.date) {
                        window.location.href = '/rooms?date=' + props.date;
                    } else if (props.type === 'booked' && props.room_slug) {
                        window.location.href = '/rooms/' + props.room_slug;
                    }
                },
                dateClick: function (info) {
                    var clicked = new Date(info.dateStr);
                    var today = new Date();
                    today.setHours(0, 0, 0, 0);
                    if (clicked >= today) {
                        window.location.href = '/rooms?date=' + info.dateStr;
                    }
                },
                dayCellClassNames: function (arg) {
                    var today = new Date();
                    today.setHours(0, 0, 0, 0);
                    return arg.date >= today ? ['fc-day-future'] : ['fc-day-past'];
                },
                eventDidMount: function (info) {
                    var props = info.event.extendedProps || {};
                    var tipText = props.type === 'available'
                        ? info.event.title + ' — klik untuk pesan'
                        : 'Terpakai: ' + info.event.title;
                    info.el.setAttribute('title', tipText);
                    info.el.style.cursor = 'pointer';
                }
            });

            calendar.render();
        });
    </script>
    @endpush
</x-guest-page-layout>
