<x-guest-page-layout>
    @php $title = $news->title; @endphp

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('news.index') }}" class="ml-1 md:ml-2 hover:text-emerald-600 transition-colors">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 md:ml-2 text-gray-700 font-medium truncate max-w-[150px] md:max-w-full">{{ $news->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <article class="bg-white rounded-3xl p-6 sm:p-12 shadow-sm border border-gray-100">
            <header class="mb-10 text-center">
                <div class="flex items-center justify-center gap-2 text-sm text-gray-500 mb-4 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Diterbitkan tanggal {{ $news->published_at?->format('d M Y') ?? '-' }}
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">{{ $news->title }}</h1>
            </header>

            @if($news->image_path && Storage::exists($news->image_path))
                <div class="rounded-2xl overflow-hidden mb-12 aspect-[21/9] bg-gray-100">
                    <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="prose prose-lg prose-emerald max-w-none prose-img:rounded-xl prose-a:text-emerald-600">
                {!! $news->content !!}
            </div>

            <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="{{ route('news.index') }}" class="inline-flex items-center text-gray-500 hover:text-emerald-600 font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Daftar Berita
                </a>
                
                <!-- Share options could go here -->
                <div class="flex gap-2">
                    <span class="text-gray-400 text-sm">Bagikan:</span>
                    <button class="text-gray-400 hover:text-emerald-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></button>
                    <button class="text-gray-400 hover:text-emerald-600 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg></button>
                </div>
            </div>
        </article>
    </div>
</x-guest-page-layout>
