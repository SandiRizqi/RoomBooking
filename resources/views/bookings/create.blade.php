<x-guest-page-layout>
    @php $title = 'Pesan ' . $room->name; @endphp

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @push('styles')
    <style>
        .flatpickr-day.disabled, .flatpickr-day.disabled:hover {
            color: #f87171 !important;
            text-decoration: line-through !important;
            background: transparent !important;
        }
        .flatpickr-calendar {
            border-radius: 1rem;
            box-shadow: 0 20px 60px -15px rgba(0,0,0,0.15);
            border: 1px solid #e7e5e4;
            padding: 8px;
            font-family: 'DM Sans', sans-serif;
        }
        .flatpickr-day.selected,
        .flatpickr-day.selected:hover {
            background-color: #2d4a22 !important;
            border-color: #2d4a22 !important;
        }
        .flatpickr-day:hover { background-color: #f0fdf4 !important; }
    </style>
    @endpush

    <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-16 py-12 lg:py-16">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.25em] text-stone-400 mb-10">
            <a href="{{ route('home') }}" class="hover:text-[#2d4a22] transition-colors">Home</a>
            <span class="text-stone-200">›</span>
            <a href="{{ route('rooms.index') }}" class="hover:text-[#2d4a22] transition-colors">Unit</a>
            <span class="text-stone-200">›</span>
            <a href="{{ route('rooms.show', $room) }}" class="hover:text-[#2d4a22] transition-colors">{{ Str::limit($room->name, 20) }}</a>
            <span class="text-stone-200">›</span>
            <span class="text-[#2d4a22]">Reservasi</span>
        </nav>

        <!-- Page Title -->
        <div class="mb-10 border-l-4 border-[#2d4a22] pl-6">
            <p class="text-[9px] font-bold text-stone-400 uppercase tracking-[0.3em] mb-2">Langkah Pemesanan</p>
            <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 ff-serif">
                Reservasi <span class="italic font-normal accent-bark">Unit Glamping</span>
            </h1>
            <p class="text-stone-500 mt-1.5 text-sm font-light">Isi detail pemesanan untuk <strong class="font-semibold text-stone-700">{{ $room->name }}</strong></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- ===== FORM SECTION ===== -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
                    <!-- Form Header -->
                    <div class="px-8 py-5 bg-stone-50 border-b border-stone-100 flex items-center gap-2">
                        <div class="w-7 h-7 bg-[#2d4a22] rounded-lg flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-sm font-bold text-stone-700 uppercase tracking-wider">Detail Pemesanan</h2>
                    </div>

                    <form action="{{ route('bookings.store', $room) }}" method="POST" class="p-8 space-y-6">
                        @csrf

                        <!-- Dates -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="check_in_date" class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-2">
                                    Tanggal Check-In <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <input type="text" id="check_in_date" name="check_in_date"
                                        value="{{ old('check_in_date') }}"
                                        class="w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl text-sm font-medium text-stone-800 focus:outline-none focus:border-[#2d4a22] focus:ring-2 focus:ring-[#2d4a22]/10 transition-all cursor-pointer @error('check_in_date') border-red-300 @enderror"
                                        placeholder="Pilih tanggal" required readonly>
                                </div>
                                @error('check_in_date')
                                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                        <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="check_out_date" class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-2">
                                    Tanggal Check-Out <span class="text-red-400">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <input type="text" id="check_out_date" name="check_out_date"
                                        value="{{ old('check_out_date') }}"
                                        class="w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl text-sm font-medium text-stone-800 focus:outline-none focus:border-[#2d4a22] focus:ring-2 focus:ring-[#2d4a22]/10 transition-all cursor-pointer @error('check_out_date') border-red-300 @enderror"
                                        placeholder="Pilih tanggal" required readonly>
                                </div>
                                <p class="text-[10px] text-stone-400 mt-1.5 font-medium">Satu malam = pilih tanggal check-in kembali.</p>
                                @error('check_out_date')
                                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Guests -->
                        <div>
                            <label for="guests" class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-2">
                                Jumlah Tamu <span class="text-red-400">*</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <input type="number" id="guests" name="guests"
                                        min="1" max="{{ $room->capacity }}"
                                        value="{{ old('guests', 1) }}"
                                        class="w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl text-sm font-medium text-stone-800 focus:outline-none focus:border-[#2d4a22] focus:ring-2 focus:ring-[#2d4a22]/10 transition-all"
                                        required>
                                </div>
                                <div class="px-4 py-3 bg-green-50 border border-green-100 rounded-xl text-xs font-bold text-[#2d4a22] shrink-0 whitespace-nowrap">
                                    Maks. {{ $room->capacity }}
                                </div>
                            </div>
                            @error('guests')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-2">
                                Catatan Khusus <span class="text-stone-300 font-normal normal-case">(Opsional)</span>
                            </label>
                            <textarea id="notes" name="notes" rows="4"
                                class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-800 focus:outline-none focus:border-[#2d4a22] focus:ring-2 focus:ring-[#2d4a22]/10 transition-all resize-none leading-relaxed"
                                placeholder="Permintaan khusus, alergi makanan, kebutuhan tambahan, dll.">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="pt-2 border-t border-stone-50">
                            <button type="submit"
                                class="w-full py-4 btn-nature font-bold rounded-xl text-base shadow-lg shadow-green-900/15 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Konfirmasi Pemesanan
                            </button>
                            <p class="text-center text-[10px] text-stone-400 mt-3">Pembayaran belum diproses. Anda dapat membatalkan kapan saja.</p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ===== SUMMARY SIDEBAR ===== -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden sticky top-24">
                    <!-- Room Image -->
                    <div class="relative h-44 bg-stone-100">
                        @if($room->cover_image)
                            <img src="{{ Storage::url($room->cover_image) }}"
                                 alt="{{ $room->name }}"
                                 class="w-full h-full object-cover"
                                 onerror="this.style.display='none'">
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center bg-stone-50 -z-10">
                            <svg class="w-10 h-10 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="absolute bottom-3 left-3 bg-white/95 backdrop-blur-sm shadow-md rounded-lg px-3 py-1.5">
                            <p class="text-base font-bold text-[#2d4a22] ff-serif leading-none">{{ $room->formatted_price }}</p>
                            <p class="text-[9px] text-stone-400 font-bold uppercase tracking-wider mt-0.5">/ Malam</p>
                        </div>
                    </div>

                    <!-- Room Info -->
                    <div class="p-6">
                        <p class="text-[9px] font-bold text-stone-400 uppercase tracking-[0.25em] mb-1">{{ $room->category ?? 'Nature Resort' }}</p>
                        <h3 class="text-lg font-bold text-stone-900 ff-serif leading-snug mb-5">{{ $room->name }}</h3>

                        <!-- Cost Breakdown -->
                        <div class="bg-stone-50 rounded-xl p-4 space-y-3 mb-5 border border-stone-100">
                            <h4 class="text-[9px] font-bold text-stone-400 uppercase tracking-[0.2em]">Ringkasan Biaya</h4>
                            <div class="flex justify-between text-sm text-stone-600">
                                <span>Harga / Malam</span>
                                <span class="font-semibold">{{ $room->formatted_price }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-stone-600">
                                <span>Durasi</span>
                                <span class="font-semibold" id="durationText">— Malam</span>
                            </div>
                            <div class="border-t border-stone-200 pt-3 flex justify-between">
                                <span class="font-bold text-stone-800 text-sm">Total Estimasi</span>
                                <span class="font-bold text-[#2d4a22] text-base ff-serif" id="totalPriceText">—</span>
                            </div>
                        </div>

                        <!-- Info Badges -->
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-xs text-stone-500 font-medium">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Gratis Batalkan
                            </div>
                            <div class="flex items-center gap-2 text-xs text-stone-500 font-medium">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Maks. {{ $room->capacity }} Tamu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pricePerDay = {{ $room->price_per_day }};

            const formatRupiah = (n) =>
                new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n);

            const updateSummary = () => {
                const ci = document.getElementById('check_in_date').value;
                const co = document.getElementById('check_out_date').value;
                if (ci && co) {
                    const start = new Date(ci), end = new Date(co);
                    if (end >= start) {
                        const diff = Math.max(1, Math.ceil(Math.abs(end - start) / 86400000));
                        document.getElementById('durationText').textContent = diff + ' Malam';
                        document.getElementById('totalPriceText').textContent = formatRupiah(diff * pricePerDay);
                    }
                }
            };

            fetch('/rooms/{{ $room->slug }}/availability')
                .then(r => r.json())
                .then(data => {
                    const bookedDates = data.booked_dates ?? [];
                    const baseCfg = {
                        locale: 'id',
                        minDate: 'today',
                        disable: bookedDates,
                        dateFormat: 'Y-m-d',
                        onChange: updateSummary,
                    };
                    const ciPicker = flatpickr('#check_in_date', baseCfg);
                    const coPicker = flatpickr('#check_out_date', {
                        ...baseCfg,
                        onChange: function (dates, dateStr, inst) {
                            const checkIn = ciPicker.selectedDates[0];
                            if (checkIn && dates[0] && dates[0] < checkIn) { inst.clear(); return; }
                            updateSummary();
                        }
                    });
                    document.getElementById('check_in_date').addEventListener('change', e => {
                        coPicker.set('minDate', e.target.value);
                        updateSummary();
                    });
                });
        });
    </script>
    @endpush
</x-guest-page-layout>
