<x-guest-page-layout>
    @php $title = 'Berita & Update'; @endphp

    {{-- Page Header --}}
    <div class="bg-[#f5f0e8] border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-14 lg:py-18">
            <span class="section-label">Berita & Informasi</span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-stone-900 ff-serif leading-tight">
                Journal <span class="italic font-light accent-bark">Diari</span> Resort
            </h1>
            <p class="text-stone-500 mt-3 text-sm font-light max-w-xl">
                Ikuti terus update terbaru, cerita inspiratif, dan promo menarik dari Glampify Resort.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-14">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
            @forelse($news as $article)
            <a href="{{ route('news.show', $article) }}"
               class="group block bg-white rounded-2xl overflow-hidden border border-stone-100 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                {{-- Image --}}
                <div class="aspect-[16/9] overflow-hidden bg-stone-50 relative">
                    @if($article->image_path && Storage::exists($article->image_path))
                        <img src="{{ Storage::url($article->image_path) }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-stone-50">
                            <svg class="w-10 h-10 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                {{-- Content --}}
                <div class="p-5">
                    <div class="flex items-center gap-2 text-[9px] font-bold text-[#2d4a22] uppercase tracking-[0.22em] mb-2.5">
                        <div class="w-1 h-3 bg-[#2d4a22] rounded-full"></div>
                        {{ $article->published_at?->format('d M Y') ?? '—' }}
                    </div>
                    <h3 class="text-base font-bold text-stone-900 leading-snug ff-serif group-hover:text-[#2d4a22] transition-colors line-clamp-2 mb-2">
                        {{ $article->title }}
                    </h3>
                    <p class="text-stone-400 text-xs leading-relaxed line-clamp-2 font-light mb-4">
                        {!! Str::limit(strip_tags($article->content), 110) !!}
                    </p>
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-[#2d4a22]">
                        Baca selengkapnya
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-16 h-16 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-8 h-8 text-stone-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <p class="text-stone-400 text-sm font-light">Belum ada berita yang diterbitkan.</p>
            </div>
            @endforelse
        </div>

        @if($news->hasPages())
        <div class="mt-12">{{ $news->links() }}</div>
        @endif
    </div>
</x-guest-page-layout>
