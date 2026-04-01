<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Glampify') }} — Admin Panel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,400i,600,700|dm-sans:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'DM Sans', sans-serif; background-color: #f4f1ea; }
            .ff-serif { font-family: 'Cormorant Garamond', serif; }
            .admin-sidebar { background: linear-gradient(180deg, #1a2d13 0%, #2d4a22 100%); }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#f4f1ea]">
        <div class="min-h-screen flex">
            <!-- Sidebar (desktop) -->
            <aside class="admin-sidebar hidden lg:flex flex-col w-64 min-h-screen shadow-xl fixed top-0 left-0 z-30">
                <!-- Brand -->
                <div class="px-6 pt-8 pb-6 border-b border-white/10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-white/15 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                <polyline stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-bold ff-serif italic text-xl leading-none">Glampify</p>
                            <p class="text-white/40 text-[9px] font-bold uppercase tracking-[0.2em] mt-0.5">Admin Panel</p>
                        </div>
                    </a>
                </div>

                <!-- Nav -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    <p class="text-white/30 text-[9px] font-bold uppercase tracking-[0.25em] px-3 mb-3">Menu Utama</p>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/></svg>
                        Dashboard
                    </a>

                    <p class="text-white/30 text-[9px] font-bold uppercase tracking-[0.25em] px-3 pt-5 mb-3">Manajemen</p>
                    <a href="/admin/rooms" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                        Unit Glamping
                    </a>
                    <a href="/admin/bookings" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Pemesanan
                    </a>
                    <a href="/admin/galleries" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Galeri
                    </a>
                    <a href="/admin/news" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        Artikel & Berita
                    </a>
                    <a href="/admin/facilities" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        Fasilitas
                    </a>
                </nav>

                <!-- User Footer -->
                <div class="px-4 py-5 border-t border-white/10">
                    <div class="flex items-center gap-3 px-3 py-2 mb-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-xs font-bold truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-white/40 text-[9px] truncate">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-white/50 hover:text-white hover:bg-white/10 transition-all text-xs font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main content -->
            <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
                <!-- Top bar -->
                <header class="bg-white border-b border-stone-100 shadow-[0_1px_10px_rgba(0,0,0,0.04)] sticky top-0 z-20">
                    <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                        <!-- Mobile logo + hamburger -->
                        <div class="flex items-center gap-3 lg:hidden">
                            <button id="admin-mob-btn" class="w-9 h-9 flex items-center justify-center rounded-xl hover:bg-stone-100 transition-colors">
                                <svg class="w-5 h-5 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>
                            <span class="text-xl font-bold text-[#2d4a22] ff-serif italic">Glampify</span>
                        </div>

                        <!-- Page title (desktop) -->
                        <div class="hidden lg:block">
                            @isset($header)
                                <div class="flex items-center gap-3">
                                    <div class="w-1 h-6 bg-[#2d4a22] rounded-full"></div>
                                    {{ $header }}
                                </div>
                            @endisset
                        </div>

                        <!-- Right items -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-2 px-3 py-1.5 text-xs font-semibold text-[#2d4a22] bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Lihat Website
                            </a>
                            <div class="w-8 h-8 bg-[#2d4a22] rounded-full flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                    </div>

                    <!-- Mobile page title -->
                    @isset($header)
                    <div class="lg:hidden px-4 pb-3 flex items-center gap-2">
                        <div class="w-1 h-5 bg-[#2d4a22] rounded-full"></div>
                        {{ $header }}
                    </div>
                    @endisset
                </header>

                <!-- Mobile Sidebar Overlay -->
                <div id="admin-overlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden" onclick="closeMobileNav()"></div>
                <aside id="admin-mob-sidebar" class="admin-sidebar fixed top-0 left-0 h-full w-72 z-50 transform -translate-x-full transition-transform duration-300 lg:hidden flex flex-col">
                    <div class="px-6 pt-8 pb-6 border-b border-white/10">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-white/15 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" points="9 22 9 12 15 12 15 22"/></svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold ff-serif italic text-xl leading-none">Glampify</p>
                                    <p class="text-white/40 text-[9px] font-bold uppercase tracking-[0.2em] mt-0.5">Admin Panel</p>
                                </div>
                            </a>
                            <button onclick="closeMobileNav()" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/10 text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/></svg>
                            Dashboard
                        </a>
                        <a href="/admin/rooms" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                            Unit Glamping
                        </a>
                        <a href="/admin/bookings" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Pemesanan
                        </a>
                        <a href="/admin/galleries" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"/></svg>
                            Galeri
                        </a>
                        <a href="/admin/news" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            Artikel & Berita
                        </a>
                        <a href="/admin/facilities" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-all text-sm font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            Fasilitas
                        </a>
                    </nav>
                    <div class="px-4 py-5 border-t border-white/10">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-white/50 hover:text-white hover:bg-white/10 transition-all text-xs font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </aside>

                <!-- Page Content -->
                <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t border-stone-100 px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-stone-400">
                        <span class="ff-serif italic font-semibold text-[#2d4a22]">Glampify Resort</span>
                        <span>&copy; {{ date('Y') }} Admin Panel. All rights reserved.</span>
                    </div>
                </footer>
            </div>
        </div>

        <script>
            function closeMobileNav() {
                document.getElementById('admin-mob-sidebar').classList.add('-translate-x-full');
                document.getElementById('admin-overlay').classList.add('hidden');
            }
            document.getElementById('admin-mob-btn')?.addEventListener('click', () => {
                document.getElementById('admin-mob-sidebar').classList.remove('-translate-x-full');
                document.getElementById('admin-overlay').classList.remove('hidden');
            });
        </script>
    </body>
</html>
