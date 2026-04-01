<x-guest-page-layout>
    @php $title = $room->name; @endphp

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-12 lg:py-16">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.25em] text-stone-400 mb-10" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#2d4a22] transition-colors">Home</a>
            <span class="text-stone-200">›</span>
            <a href="{{ route('rooms.index') }}" class="hover:text-[#2d4a22] transition-colors">Semua Unit</a>
            <span class="text-stone-200">›</span>
            <span class="text-[#2d4a22]">{{ Str::limit($room->name, 30) }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-14 items-start">

            <!-- ===== LEFT COLUMN: Images + Details ===== -->
            <div class="lg:col-span-2 space-y-8">

                <!-- Main Image Slider -->
                <div class="rounded-2xl overflow-hidden bg-stone-100 aspect-[16/10] relative group shadow-xl border border-stone-100">
                    <style>
                        .slider-track { -ms-overflow-style: none; scrollbar-width: none; }
                        .slider-track::-webkit-scrollbar { display: none; }
                    </style>
                    <div class="slider-track flex w-full h-full overflow-x-auto snap-x snap-mandatory scroll-smooth" id="roomSlider">
                        @if($room->cover_image)
                            <div class="w-full h-full flex-none snap-center bg-stone-50 relative" id="slide-0">
                                <img src="{{ Storage::url($room->cover_image) }}"
                                     alt="{{ $room->name }}"
                                     onerror="this.style.opacity='0'"
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 flex items-center justify-center -z-10">
                                    <svg class="w-16 h-16 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            </div>
                        @endif
                        @if($room->images && is_array($room->images))
                            @foreach($room->images as $index => $img)
                            <div class="w-full h-full flex-none snap-center bg-stone-50 relative" id="slide-{{ $index+1 }}">
                                <img src="{{ Storage::url($img) }}"
                                     alt="View {{ $index+1 }}"
                                     onerror="this.style.opacity='0'"
                                     class="w-full h-full object-cover">
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Navigation Arrows -->
                    @if($room->images && is_array($room->images) && count($room->images) > 0)
                    <button onclick="scrollSlider('left')"
                        class="absolute top-1/2 left-4 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white text-stone-700 rounded-full backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 shadow-lg border border-stone-100 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button onclick="scrollSlider('right')"
                        class="absolute top-1/2 right-4 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white text-stone-700 rounded-full backdrop-blur-sm transition-all opacity-0 group-hover:opacity-100 shadow-lg border border-stone-100 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                    @endif

                    <!-- Slide Counter -->
                    @php $totalSlides = ($room->cover_image ? 1 : 0) + (is_array($room->images) ? count($room->images) : 0); @endphp
                    @if($totalSlides > 1)
                    <div class="absolute bottom-4 right-4 px-3 py-1.5 bg-black/50 backdrop-blur-sm rounded-lg text-white text-xs font-bold" id="slideCounter">1 / {{ $totalSlides }}</div>
                    @endif
                </div>

                <!-- Thumbnails -->
                @if($room->images && is_array($room->images) && count($room->images) > 0)
                <div class="flex gap-3 overflow-x-auto pb-1 slider-track">
                    @if($room->cover_image)
                    <button onclick="goToSlide(0, this)"
                        class="thumb-btn h-20 w-32 flex-none rounded-xl overflow-hidden ring-2 ring-[#2d4a22] ring-offset-2 opacity-100 transition-all shadow-md">
                        <img src="{{ Storage::url($room->cover_image) }}" class="w-full h-full object-cover">
                    </button>
                    @endif
                    @foreach($room->images as $index => $image)
                    <button onclick="goToSlide({{ $index+1 }}, this)"
                        class="thumb-btn h-20 w-32 flex-none rounded-xl overflow-hidden ring-2 ring-transparent ring-offset-2 opacity-50 hover:opacity-80 transition-all">
                        <img src="{{ Storage::url($image) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif

                <!-- Description Card -->
                <div class="bg-white rounded-2xl p-8 lg:p-10 border border-stone-100 shadow-sm">
                    <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 ff-serif mb-6 italic">
                        Tentang <span class="not-italic font-bold text-[#2d4a22]">{{ $room->name }}</span>
                    </h2>
                    <div class="prose prose-stone max-w-none text-stone-500 leading-relaxed text-base font-light">
                        {!! $room->description !!}
                    </div>
                </div>

                <!-- Facilities Card -->
                @if($room->facilities->count())
                <div class="bg-white rounded-2xl p-8 lg:p-10 border border-stone-100 shadow-sm">
                    <h2 class="text-2xl font-bold text-stone-900 ff-serif mb-6">
                        Fasilitas <span class="italic font-normal accent-bark">Unggulan</span>
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($room->facilities as $facility)
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-stone-50 border border-stone-100 hover:border-[#2d4a22]/20 hover:bg-green-50/50 transition-all group">
                            <span class="text-2xl group-hover:scale-110 transition-transform">{{ $facility->icon }}</span>
                            <span class="font-semibold text-stone-700 text-sm">{{ $facility->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- ===== RIGHT COLUMN: Booking Widget ===== -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-stone-100 sticky top-28">
                    <!-- Category -->
                    <p class="text-[9px] font-bold text-stone-400 uppercase tracking-[0.3em] mb-2">{{ $room->category ?? 'Boutique Glamping' }}</p>

                    <!-- Room Name -->
                    <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 ff-serif mb-6 leading-snug italic">{{ $room->name }}</h1>

                    <!-- Price -->
                    <div class="flex items-baseline gap-2 mb-8 pb-8 border-b border-stone-100">
                        <span class="text-3xl font-bold text-[#2d4a22] tracking-tight">{{ $room->formatted_price }}</span>
                        <span class="text-stone-400 text-xs font-bold uppercase tracking-wider">/ Malam</span>
                    </div>

                    <!-- Capacity -->
                    <div class="flex items-center gap-4 mb-8 p-4 bg-stone-50 rounded-xl border border-stone-100">
                        <div class="w-10 h-10 rounded-xl bg-green-50 border border-green-100 flex items-center justify-center text-[#2d4a22] flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-stone-400 uppercase tracking-wider mb-0.5">Kapasitas Maks.</p>
                            <p class="font-bold text-stone-800 text-sm">{{ $room->capacity }} Tamu</p>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="{{ route('bookings.create', $room) }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 btn-nature font-bold rounded-xl shadow-lg shadow-green-950/15 text-base transition-all hover:-translate-y-0.5 mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Reservasi Sekarang
                    </a>

                    <!-- Trust Badges -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-xs text-stone-400 font-medium">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Pembayaran belum diproses sekarang
                        </div>
                        <div class="flex items-center gap-2 text-xs text-stone-400 font-medium">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Dapat dibatalkan kapan saja
                        </div>
                        <div class="flex items-center gap-2 text-xs text-stone-400 font-medium">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Support 24 jam sehari
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let currentSlide = 0;
        const slider = document.getElementById('roomSlider');
        const counter = document.getElementById('slideCounter');

        function scrollSlider(direction) {
            const width = slider.clientWidth;
            slider.scrollBy({ left: direction === 'left' ? -width : width, behavior: 'smooth' });
        }

        function goToSlide(index, el) {
            const slide = document.getElementById('slide-' + index);
            if (slide) {
                slider.scrollTo({ left: slide.offsetLeft, behavior: 'smooth' });
                updateThumbs(index);
            }
        }

        function updateThumbs(index) {
            document.querySelectorAll('.thumb-btn').forEach((btn, i) => {
                if (i === index) {
                    btn.classList.add('ring-[#2d4a22]', 'opacity-100', 'shadow-md');
                    btn.classList.remove('ring-transparent', 'opacity-50');
                } else {
                    btn.classList.remove('ring-[#2d4a22]', 'opacity-100', 'shadow-md');
                    btn.classList.add('ring-transparent', 'opacity-50');
                }
            });
        }

        let scrollTimer;
        slider?.addEventListener('scroll', () => {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(() => {
                const idx = Math.round(slider.scrollLeft / slider.clientWidth);
                updateThumbs(idx);
                if (counter) {
                    const total = document.querySelectorAll('.thumb-btn').length;
                    counter.textContent = (idx + 1) + ' / ' + total;
                }
            }, 60);
        });
    </script>
    @endpush
</x-guest-page-layout>
