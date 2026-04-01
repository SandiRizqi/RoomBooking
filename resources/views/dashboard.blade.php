<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-stone-800 ff-serif">
            Dasbor <span class="text-[#2d4a22] italic font-normal">Glampify</span>
        </h1>
    </x-slot>

    <div class="space-y-8">
        <!-- Welcome Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#2d4a22] to-[#1a2d13] p-8 lg:p-10 text-white">
            <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute right-16 bottom-0 w-32 h-32 bg-white/5 rounded-full"></div>
            <div class="relative z-10">
                <p class="text-white/60 text-xs font-bold uppercase tracking-[0.3em] mb-3">Selamat Datang</p>
                <h2 class="text-3xl sm:text-4xl font-bold ff-serif italic mb-2">
                    {{ Auth::user()->name ?? 'Admin' }}
                </h2>
                <p class="text-white/60 text-sm font-light">
                    Panel manajemen resort Glampify — {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="mt-8 flex flex-wrap gap-4 relative z-10">
                <a href="/admin/bookings" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-[#2d4a22] text-xs font-bold rounded-xl hover:bg-stone-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Lihat Semua Pemesanan
                </a>
                <a href="/admin/rooms/create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 text-white text-xs font-bold rounded-xl hover:bg-white/20 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Unit
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        @php
            $totalBookings = \App\Models\Booking::count();
            $paidBookings = \App\Models\Booking::where('payment_status', 'paid')->count();
            $unpaidBookings = \App\Models\Booking::where('payment_status', 'unpaid')->count();
            $totalRevenue = \App\Models\Booking::where('payment_status', 'paid')->sum('total_price');
            $activeRooms = \App\Models\Room::where('is_active', true)->count();
            $totalRooms = \App\Models\Room::count();
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Total Pemesanan -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-stone-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                </div>
                <p class="text-2xl sm:text-3xl font-bold text-stone-900 ff-serif">{{ $totalBookings }}</p>
                <p class="text-xs text-stone-400 font-semibold mt-1 uppercase tracking-wide">Total Pemesanan</p>
            </div>

            <!-- Pendapatan -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-stone-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-xl sm:text-2xl font-bold text-stone-900 ff-serif">Rp {{ number_format($totalRevenue / 1000000, 1) }}jt</p>
                <p class="text-xs text-stone-400 font-semibold mt-1 uppercase tracking-wide">Total Pendapatan</p>
            </div>

            <!-- Unit Aktif -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-stone-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                    </div>
                </div>
                <p class="text-2xl sm:text-3xl font-bold text-stone-900 ff-serif">{{ $activeRooms }}<span class="text-stone-300 text-lg">/{{ $totalRooms }}</span></p>
                <p class="text-xs text-stone-400 font-semibold mt-1 uppercase tracking-wide">Unit Aktif</p>
            </div>

            <!-- Menunggu Konfirmasi -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-stone-100 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl sm:text-3xl font-bold text-stone-900 ff-serif">{{ $unpaidBookings }}</p>
                <p class="text-xs text-stone-400 font-semibold mt-1 uppercase tracking-wide">Belum Bayar</p>
            </div>
        </div>

        <!-- Recent Bookings Table -->
        <div class="bg-white rounded-2xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-stone-50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-stone-800 ff-serif">Pemesanan Terbaru</h3>
                    <p class="text-xs text-stone-400 mt-0.5">10 pemesanan terakhir masuk</p>
                </div>
                <a href="/admin/bookings" class="self-start sm:self-auto text-xs font-bold text-[#2d4a22] hover:underline">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto">
                @php
                    $recentBookings = \App\Models\Booking::with(['user','room'])->latest()->take(10)->get();
                @endphp
                @if($recentBookings->count())
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-stone-50">
                            <th class="text-left px-6 py-3 text-[10px] font-bold text-stone-400 uppercase tracking-wider">Kode</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold text-stone-400 uppercase tracking-wider hidden sm:table-cell">Tamu</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold text-stone-400 uppercase tracking-wider hidden md:table-cell">Unit</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold text-stone-400 uppercase tracking-wider hidden lg:table-cell">Check-in</th>
                            <th class="text-left px-6 py-3 text-[10px] font-bold text-stone-400 uppercase tracking-wider">Status</th>
                            <th class="text-right px-6 py-3 text-[10px] font-bold text-stone-400 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-50">
                        @foreach($recentBookings as $booking)
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-bold text-[#2d4a22]">{{ $booking->booking_code }}</td>
                            <td class="px-6 py-4 text-stone-700 font-medium hidden sm:table-cell">{{ $booking->user->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-stone-500 hidden md:table-cell text-xs">{{ Str::limit($booking->room->name ?? '-', 20) }}</td>
                            <td class="px-6 py-4 text-stone-500 hidden lg:table-cell text-xs">{{ $booking->check_in_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($booking->payment_status === 'paid')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-50 text-emerald-700">Lunas</span>
                                @elseif($booking->payment_status === 'unpaid')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-50 text-amber-700">Pending</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-red-50 text-red-700">Batal</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-stone-800 text-xs">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="py-16 text-center">
                    <div class="w-16 h-16 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <p class="text-stone-400 text-sm">Belum ada pemesanan.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="/admin/rooms" class="bg-white rounded-2xl p-5 border border-stone-100 hover:border-[#2d4a22] hover:shadow-md transition-all group text-center">
                <div class="w-10 h-10 bg-stone-50 group-hover:bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <svg class="w-5 h-5 text-stone-400 group-hover:text-[#2d4a22] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                </div>
                <p class="text-xs font-bold text-stone-600 group-hover:text-[#2d4a22] transition-colors">Unit Glamping</p>
            </a>
            <a href="/admin/galleries" class="bg-white rounded-2xl p-5 border border-stone-100 hover:border-[#2d4a22] hover:shadow-md transition-all group text-center">
                <div class="w-10 h-10 bg-stone-50 group-hover:bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <svg class="w-5 h-5 text-stone-400 group-hover:text-[#2d4a22] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-xs font-bold text-stone-600 group-hover:text-[#2d4a22] transition-colors">Galeri</p>
            </a>
            <a href="/admin/news" class="bg-white rounded-2xl p-5 border border-stone-100 hover:border-[#2d4a22] hover:shadow-md transition-all group text-center">
                <div class="w-10 h-10 bg-stone-50 group-hover:bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <svg class="w-5 h-5 text-stone-400 group-hover:text-[#2d4a22] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <p class="text-xs font-bold text-stone-600 group-hover:text-[#2d4a22] transition-colors">Artikel</p>
            </a>
            <a href="/admin/facilities" class="bg-white rounded-2xl p-5 border border-stone-100 hover:border-[#2d4a22] hover:shadow-md transition-all group text-center">
                <div class="w-10 h-10 bg-stone-50 group-hover:bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <svg class="w-5 h-5 text-stone-400 group-hover:text-[#2d4a22] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <p class="text-xs font-bold text-stone-600 group-hover:text-[#2d4a22] transition-colors">Fasilitas</p>
            </a>
        </div>
    </div>
</x-app-layout>
