<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Glampify' }} — Luxury Glamping Resort</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,400i,600,700,700i|dm-sans:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --forest: #2d4a22;
            --forest-dark: #1a2d13;
            --forest-light: #3d6030;
            --bark: #7c5c40;
            --cream: #fdfbf7;
            --parchment: #f5f0e8;
            --mist: #e8e2d6;
        }
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background-color: var(--cream); }
        .ff-serif { font-family: 'Cormorant Garamond', serif; }
        .accent-bark { color: var(--bark); }
        .bg-nature { background-color: var(--cream); }
        .bg-parchment { background-color: var(--parchment); }
        .text-forest { color: var(--forest); }

        .btn-nature {
            background-color: var(--forest);
            color: #fff;
            transition: all 0.25s ease;
        }
        .btn-nature:hover {
            background-color: var(--forest-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 24px -6px rgba(45,74,34,0.35);
        }
        .btn-outline-nature {
            border: 1.5px solid var(--forest);
            color: var(--forest);
            background: transparent;
            transition: all 0.25s ease;
        }
        .btn-outline-nature:hover {
            background-color: var(--forest);
            color: #fff;
        }

        /* ===== Navbar ===== */
        .nav-item {
            position: relative;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #57534e;
            transition: color 0.25s;
            padding-bottom: 2px;
            white-space: nowrap;
        }
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 1.5px;
            background: var(--forest);
            transition: width 0.25s ease;
        }
        .nav-item:hover { color: var(--forest); }
        .nav-item:hover::after { width: 100%; }
        .nav-item.active { color: var(--forest); }
        .nav-item.active::after { width: 100%; }

        /* ===== Dropdown ===== */
        .user-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            width: 220px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px -12px rgba(0,0,0,0.18), 0 4px 16px -4px rgba(0,0,0,0.08);
            border: 1px solid #f5f5f4;
            padding: 8px 0;
            z-index: 100;
            overflow: hidden;
            animation: dropIn 0.15s ease;
        }
        .user-dropdown-menu.active { display: block; }
        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-6px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background-color: var(--forest);
            color: #fff;
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: background-color 0.2s;
            white-space: nowrap;
        }
        .user-dropdown-btn:hover { background-color: var(--forest-dark); }
        .user-dropdown-btn svg.chevron {
            transition: transform 0.2s;
        }
        .user-dropdown-btn.open svg.chevron { transform: rotate(180deg); }

        /* ===== Mobile nav ===== */
        #mobile-menu {
            transition: max-height 0.35s ease, opacity 0.25s ease;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }
        #mobile-menu.open {
            max-height: 600px;
            opacity: 1;
        }

        /* ===== Flash message ===== */
        .flash-msg { animation: slideDown 0.35s ease; }
        @keyframes slideDown {
            from { transform: translateY(-8px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }

        /* ===== Hide scrollbar ===== */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* ===== Section label ===== */
        .section-label {
            display: inline-block;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--forest);
            border: 1px solid rgba(45,74,34,0.2);
            background: rgba(45,74,34,0.05);
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 20px;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-nature text-stone-900 antialiased min-h-screen flex flex-col">

    <!-- ===== NAVIGATION ===== -->
    <nav class="sticky top-0 z-50 bg-white/96 backdrop-blur-md border-b border-stone-100 shadow-[0_1px_20px_rgba(0,0,0,0.05)]">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
                    <div class="w-8 h-8 bg-[#2d4a22] rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="white" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline stroke-linecap="round" stroke-linejoin="round" stroke-width="2" points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <span class="text-[1.35rem] font-bold text-[#2d4a22] ff-serif italic tracking-tight leading-none">Glampify</span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-6 xl:gap-8">
                    <a href="{{ route('rooms.index') }}" class="nav-item {{ request()->routeIs('rooms.*') ? 'active' : '' }}">Unit</a>
                    <a href="{{ request()->routeIs('home') ? '#availability' : route('home').'#availability' }}" class="nav-item">Ketersediaan</a>
                    <a href="{{ route('news.index') }}" class="nav-item {{ request()->routeIs('news.*') ? 'active' : '' }}">Berita</a>

                    @auth
                        <a href="{{ route('bookings.my') }}" class="nav-item {{ request()->routeIs('bookings.*') ? 'active' : '' }}">Pesanan Saya</a>
                        <!-- User Dropdown (vanilla JS, no Alpine dependency) -->
                        <div class="relative" id="user-dd-wrap">
                            <button id="user-dd-btn" class="user-dropdown-btn" type="button">
                                <div style="width:22px;height:22px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;flex-shrink:0;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Str::limit(Auth::user()->name, 14) }}</span>
                                <svg class="chevron w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div id="user-dd-menu" class="user-dropdown-menu">
                                <div style="padding:12px 16px 10px;border-bottom:1px solid #f5f5f4;margin-bottom:4px;">
                                    <p style="font-size:0.8rem;font-weight:700;color:#1c1917;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->name }}</p>
                                    <p style="font-size:0.68rem;color:#a8a29e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:8px;padding:10px 16px;font-size:0.82rem;color:#44403c;font-weight:500;transition:background 0.15s;" onmouseover="this.style.background='#fafaf9'" onmouseout="this.style.background=''">
                                    <svg style="width:15px;height:15px;opacity:0.5;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profil Saya
                                </a>
                                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                    @csrf
                                    <button type="submit" style="width:100%;display:flex;align-items:center;gap:8px;padding:10px 16px;font-size:0.82rem;color:#ef4444;font-weight:500;background:none;border:none;cursor:pointer;text-align:left;transition:background 0.15s;" onmouseover="this.style.background='#fff5f5'" onmouseout="this.style.background=''">
                                        <svg style="width:15px;height:15px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-item">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 btn-nature text-xs font-bold rounded-xl">Daftar Gratis</a>
                    @endauth
                </div>

                <!-- Hamburger (mobile) -->
                <button id="hamburger-btn" class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-[5px] rounded-xl hover:bg-stone-50 transition-colors" aria-label="Menu">
                    <span class="w-5 h-[2px] bg-stone-600 rounded-full transition-all duration-300" id="hb-1"></span>
                    <span class="w-5 h-[2px] bg-stone-600 rounded-full transition-all duration-300" id="hb-2"></span>
                    <span class="w-4 h-[2px] bg-stone-600 rounded-full transition-all duration-300" id="hb-3"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden border-t border-stone-100 bg-white">
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
                <a href="{{ route('rooms.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-stone-700 hover:bg-stone-50 hover:text-[#2d4a22] transition-colors {{ request()->routeIs('rooms.*') ? 'bg-green-50 text-[#2d4a22]' : '' }}">
                    <svg class="w-4 h-4 opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                    Unit Glamping
                </a>
                <a href="{{ route('home') }}#availability" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-stone-700 hover:bg-stone-50 hover:text-[#2d4a22] transition-colors">
                    <svg class="w-4 h-4 opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Ketersediaan
                </a>
                <a href="{{ route('news.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-stone-700 hover:bg-stone-50 hover:text-[#2d4a22] transition-colors {{ request()->routeIs('news.*') ? 'bg-green-50 text-[#2d4a22]' : '' }}">
                    <svg class="w-4 h-4 opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    Berita Resort
                </a>

                @auth
                <a href="{{ route('bookings.my') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-stone-700 hover:bg-stone-50 hover:text-[#2d4a22] transition-colors">
                    <svg class="w-4 h-4 opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Pesanan Saya
                </a>
                <div class="border-t border-stone-100 my-2 pt-2">
                    <div class="px-4 py-2.5 flex items-center gap-3">
                        <div class="w-9 h-9 bg-[#2d4a22] rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-stone-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-stone-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-stone-600 hover:bg-stone-50 transition-colors">
                        <svg class="w-4 h-4 opacity-50 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profil Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
                @else
                <div class="border-t border-stone-100 pt-4 mt-2 grid grid-cols-2 gap-3 px-2 pb-2">
                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 btn-outline-nature text-sm font-bold rounded-xl">Masuk</a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 btn-nature text-sm font-bold rounded-xl">Daftar</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-5 sm:px-8 pt-4 flash-msg">
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-xl text-sm font-medium">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-5 sm:px-8 pt-4 flash-msg">
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-xl text-sm font-medium">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main class="flex-1">
        {{ $slot }}
    </main>

    @stack('scripts')

    <script>
        /* ---- Hamburger / Mobile Menu ---- */
        const btn  = document.getElementById('hamburger-btn');
        const menu = document.getElementById('mobile-menu');
        const hb1  = document.getElementById('hb-1');
        const hb2  = document.getElementById('hb-2');
        const hb3  = document.getElementById('hb-3');
        let menuOpen = false;

        btn?.addEventListener('click', () => {
            menuOpen = !menuOpen;
            menu.classList.toggle('open', menuOpen);
            hb1.style.transform = menuOpen ? 'rotate(45deg) translate(4px, 4px)' : '';
            hb2.style.opacity   = menuOpen ? '0' : '1';
            hb3.style.transform = menuOpen ? 'rotate(-45deg) translate(4px, -5px)' : '';
            hb3.style.width     = menuOpen ? '20px' : '';
        });

        /* ---- Desktop User Dropdown (vanilla JS) ---- */
        const ddBtn  = document.getElementById('user-dd-btn');
        const ddMenu = document.getElementById('user-dd-menu');
        const ddWrap = document.getElementById('user-dd-wrap');

        if (ddBtn && ddMenu) {
            ddBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = ddMenu.classList.toggle('active');
                ddBtn.classList.toggle('open', isOpen);
            });
            // Close on outside click
            document.addEventListener('click', (e) => {
                if (!ddWrap.contains(e.target)) {
                    ddMenu.classList.remove('active');
                    ddBtn.classList.remove('open');
                }
            });
            // Close on Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    ddMenu.classList.remove('active');
                    ddBtn.classList.remove('open');
                }
            });
        }
    </script>
</body>
</html>
