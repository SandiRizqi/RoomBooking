<x-guest-page-layout>
    @php $title = 'Pesanan Saya'; @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">

        <!-- Page Header -->
        <div class="mb-10 border-l-4 border-[#2d4a22] pl-6">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-[0.3em] mb-2">Area Member</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-stone-900 ff-serif">
                Riwayat <span class="italic accent-bark font-normal">Pemesanan</span>
            </h1>
            <p class="text-stone-500 mt-2 text-sm font-light">Semua pesanan glamping Anda tersimpan di sini.</p>
        </div>

        <!-- Booking List -->
        <div class="space-y-5">
            @forelse($bookings as $booking)
            <div class="bg-white rounded-3xl border border-stone-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="flex flex-col sm:flex-row">
                    <!-- Room Image -->
                    <div class="relative w-full sm:w-52 h-48 sm:h-auto shrink-0 img-wrapper bg-stone-100">
                        @if($booking->room->cover_image)
                            <img src="{{ Storage::url($booking->room->cover_image) }}"
                                 alt="{{ $booking->room->name }}"
                                 class="w-full h-full object-cover"
                                 loading="lazy"
                                 onerror="this.style.display='none'">
                        @endif
                        <div class="img-placeholder">
                            <svg class="w-10 h-10 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <!-- Status badge overlay on mobile -->
                        <div class="absolute top-4 left-4 sm:hidden">
                            @if($booking->payment_status === 'paid')
                                <span class="px-3 py-1.5 bg-emerald-500 text-white text-[10px] font-bold rounded-lg">Lunas</span>
                            @elseif($booking->payment_status === 'unpaid')
                                <span class="px-3 py-1.5 bg-amber-500 text-white text-[10px] font-bold rounded-lg">Pending</span>
                            @else
                                <span class="px-3 py-1.5 bg-red-500 text-white text-[10px] font-bold rounded-lg">Dibatalkan</span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 p-6 sm:p-8 flex flex-col sm:flex-row gap-6">
                        <div class="flex-1">
                            <!-- Top row -->
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <h3 class="text-xl font-bold text-stone-900 ff-serif leading-tight">{{ $booking->room->name }}</h3>
                                <!-- Status badge (desktop) -->
                                <div class="hidden sm:block">
                                    @if($booking->payment_status === 'paid')
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-lg border border-emerald-100">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                            Lunas
                                        </span>
                                    @elseif($booking->payment_status === 'unpaid')
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-lg border border-amber-100">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                            Menunggu Pembayaran
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-700 text-[10px] font-bold rounded-lg border border-red-100">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                            Dibatalkan
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Booking Code -->
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-[#2d4a22]/5 rounded-lg mb-5">
                                <svg class="w-3.5 h-3.5 text-[#2d4a22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                <span class="font-mono text-xs font-bold text-[#2d4a22]">{{ $booking->booking_code }}</span>
                            </div>

                            <!-- Details Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                <div>
                                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Check-in</p>
                                    <p class="text-sm font-semibold text-stone-800">{{ $booking->check_in_date->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Check-out</p>
                                    <p class="text-sm font-semibold text-stone-800">{{ $booking->check_out_date->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Tamu</p>
                                    <p class="text-sm font-semibold text-stone-800">{{ $booking->guests }} Orang</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Total</p>
                                    <p class="text-sm font-bold text-[#2d4a22]">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex sm:flex-col gap-3 sm:w-36 shrink-0 justify-end sm:justify-start sm:border-l sm:border-stone-100 sm:pl-6">
                            <a href="{{ route('bookings.show', $booking) }}"
                               class="flex-1 sm:flex-none flex items-center justify-center gap-1.5 px-4 py-2.5 border border-stone-200 text-stone-700 text-xs font-bold rounded-xl hover:bg-stone-50 hover:border-stone-300 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                            @if($booking->payment_status === 'paid')
                            <a href="{{ route('bookings.print', $booking) }}"
                               class="flex-1 sm:flex-none flex items-center justify-center gap-1.5 px-4 py-2.5 btn-nature text-xs font-bold rounded-xl">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                Tiket
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-3xl border border-stone-100 border-dashed py-20 text-center">
                <div class="w-20 h-20 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-stone-900 ff-serif italic mb-3">Belum Ada Pemesanan</h3>
                <p class="text-stone-400 font-light max-w-md mx-auto mb-8 text-sm">Mulai petualangan glamping Anda. Temukan unit impian dan buat kenangan tak terlupakan.</p>
                <a href="{{ route('rooms.index') }}" class="inline-flex items-center gap-2 px-8 py-4 btn-nature font-bold rounded-2xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                    Jelajahi Unit
                </a>
            </div>
            @endforelse
        </div>

        @if($bookings->hasPages())
        <div class="mt-10">{{ $bookings->links() }}</div>
        @endif
    </div>
</x-guest-page-layout>
