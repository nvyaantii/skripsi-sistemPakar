@extends('layouts.app')

@section('content')
    <!-- Hero Banner -->
    <div class="relative text-center text-white py-16 mb-8 bg-cover bg-center"
         style="background-image: url('{{ asset('images/bg-mental.jpg') }}')">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10">
            <p class="mb-2 text-lg">Cari Tahu Lebih Banyak Tentang Kesehatan Mental</p>
            <h2 class="text-3xl font-bold">Latest News</h2>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <!-- Main Artikel -->
        <div class="lg:col-span-2">
            @if($artikels->count() > 0)
                @php $main = $artikels->first(); @endphp
                <div class="bg-white rounded-lg shadow p-5 mb-6">
                    <img src="{{ asset('storage/'.$main->foto) }}" 
                         class="w-full h-64 object-cover rounded mb-4" 
                         alt="{{ $main->judul }}">
                    <h3 class="text-2xl font-bold mb-2">{{ $main->judul }}</h3>
                    <p class="text-sm text-gray-500 mb-3">
                        <i class="bi bi-clock"></i> {{ $main->created_at->format('d M Y') }}
                    </p>
                    <p class="text-gray-700">{{ Str::limit(strip_tags($main->deskripsi), 300, '...') }}</p>
                    <!-- Tombol Read More -->
                    <a href="{{ route('artikel.show', $main->id) }}" 
                       class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Read More
                    </a>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Search -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form action="{{ route('artikel.index') }}" method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search..."
                           class="flex-1 border border-gray-300 rounded-l-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                    <button type="submit" class="bg-green-600 text-white px-4 rounded-r-lg hover:bg-green-700">
                        🔍
                    </button>
                </form>
            </div>

            <!-- Latest Posts -->
            <div class="bg-white rounded-lg shadow p-4">
                <h5 class="font-bold mb-4 text-lg">Latest Posts</h5>
                @foreach($artikels->skip(1)->take(3) as $post)
                    <div class="flex items-center gap-4 mb-3">
                        <a href="{{ route('artikel.show', $post->id) }}">
                            <img src="{{ asset('storage/'.$post->foto) }}" 
                                 class="w-20 h-16 object-cover rounded" 
                                 alt="{{ $post->judul }}">
                        </a>
                        <div class="space-y-1">
                            <a href="{{ route('artikel.show', $post->id) }}" 
                               class="text-gray-800 font-semibold block hover:text-green-600">
                                {{ Str::limit($post->judul, 40) }}
                            </a>
                            <small class="text-gray-500">{{ $post->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
