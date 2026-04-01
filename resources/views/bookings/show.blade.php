<x-guest-page-layout>
    @php $title = 'Detail Pesanan ' . $booking->booking_code; @endphp

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">

        <!-- Back + actions row -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
            <a href="{{ route('bookings.my') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-stone-500 hover:text-[#2d4a22] transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Pesanan
            </a>
            @if($booking->payment_status === 'paid')
                <a href="{{ route('bookings.print', $booking) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 btn-nature text-sm font-bold rounded-xl self-start sm:self-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak Tiket
                </a>
            @endif
        </div>

        <!-- Status Banner -->
        @if($booking->payment_status === 'paid')
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-6 py-4 mb-6 flex items-center gap-4">
            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-emerald-800">Pembayaran Diterima</p>
                <p class="text-xs text-emerald-600 font-light">Pemesanan Anda telah dikonfirmasi dan siap dicetak.</p>
            </div>
        </div>
        @elseif($booking->payment_status === 'unpaid')
        <div class="bg-amber-50 border border-amber-200 rounded-2xl px-6 py-4 mb-6 flex items-center gap-4">
            <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-amber-800">Menunggu Pembayaran</p>
                <p class="text-xs text-amber-600 font-light">Segera selesaikan pembayaran untuk mengkonfirmasi reservasi.</p>
            </div>
        </div>
        @endif

        <!-- Main Card -->
        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden">

            <!-- Header -->
            <div class="bg-stone-50 px-8 py-6 border-b border-stone-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-[0.3em] mb-1.5">Kode Pemesanan</p>
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-2xl font-bold text-[#2d4a22]">{{ $booking->booking_code }}</span>
                    </div>
                </div>
                <div class="text-left sm:text-right">
                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-[0.3em] mb-1.5">Dipesan pada</p>
                    <p class="text-sm font-semibold text-stone-700">{{ $booking->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>

            <!-- Room Detail -->
            <div class="p-8 border-b border-stone-100">
                <div class="flex flex-col sm:flex-row gap-6">
                    <!-- Image -->
                    <div class="w-full sm:w-44 h-40 sm:h-36 rounded-2xl overflow-hidden bg-stone-100 shrink-0 img-wrapper">
                        @if($booking->room->cover_image)
                            <img src="{{ Storage::url($booking->room->cover_image) }}"
                                 alt="{{ $booking->room->name }}"
                                 class="w-full h-full object-cover"
                                 loading="lazy"
                                 onerror="this.style.display='none'">
                        @endif
                        <div class="img-placeholder">
                            <svg class="w-8 h-8 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <!-- Info -->
                    <div class="flex-1">
                        <p class="text-[9px] font-bold text-stone-400 uppercase tracking-[0.2em] mb-1">{{ $booking->room->category ?? 'Nature Glamping' }}</p>
                        <h2 class="text-2xl font-bold text-stone-900 ff-serif mb-5">{{ $booking->room->name }}</h2>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <div class="bg-stone-50 rounded-xl p-4 border border-stone-100">
                                <p class="text-[9px] font-bold text-stone-400 uppercase tracking-wider mb-1.5">Check-in</p>
                                <p class="text-sm font-bold text-stone-800">{{ $booking->check_in_date->format('d M Y') }}</p>
                            </div>
                            <div class="bg-stone-50 rounded-xl p-4 border border-stone-100">
                                <p class="text-[9px] font-bold text-stone-400 uppercase tracking-wider mb-1.5">Check-out</p>
                                <p class="text-sm font-bold text-stone-800">{{ $booking->check_out_date->format('d M Y') }}</p>
                            </div>
                            <div class="bg-stone-50 rounded-xl p-4 border border-stone-100">
                                <p class="text-[9px] font-bold text-stone-400 uppercase tracking-wider mb-1.5">Tamu</p>
                                <p class="text-sm font-bold text-stone-800">{{ $booking->guests }} Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Columns -->
            <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-10">
                <!-- Pemesan -->
                <div>
                    <h3 class="text-xs font-bold text-stone-500 uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#2d4a22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Data Pemesan
                    </h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Nama Lengkap</dt>
                            <dd class="text-sm font-semibold text-stone-800">{{ $booking->user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Email</dt>
                            <dd class="text-sm font-semibold text-stone-800">{{ $booking->user->email }}</dd>
                        </div>
                        @if($booking->notes)
                        <div>
                            <dt class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Catatan Khusus</dt>
                            <dd class="text-sm text-stone-700 italic bg-amber-50 border border-amber-100 px-4 py-3 rounded-xl leading-relaxed">{{ $booking->notes }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Tagihan -->
                <div>
                    <h3 class="text-xs font-bold text-stone-500 uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#2d4a22]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Rincian Tagihan
                    </h3>
                    @php
                        $days = max(1, $booking->check_in_date->diffInDays($booking->check_out_date));
                    @endphp
                    <div class="bg-stone-50 rounded-2xl p-6 border border-stone-100">
                        <div class="space-y-3 mb-4 pb-4 border-b border-stone-200">
                            <div class="flex justify-between text-sm text-stone-600">
                                <span>Harga per Malam</span>
                                <span class="font-medium">Rp {{ number_format($booking->room->price_per_day, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-stone-600">
                                <span>Durasi</span>
                                <span class="font-medium">{{ $days }} Malam</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-stone-800">Total Tagihan</span>
                            <span class="text-xl font-bold text-[#2d4a22] ff-serif">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @if($booking->payment_status === 'unpaid')
                    <div class="mt-5">
                        <button class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-gradient-to-r from-[#2d4a22] to-[#3d6030] text-white font-bold rounded-2xl shadow-xl shadow-green-900/20 hover:shadow-green-900/30 transition-all hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            Bayar Sekarang
                        </button>
                        <p class="text-center text-[10px] text-stone-400 mt-2">Integrasi payment gateway akan ditambahkan.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-page-layout>
