@extends('layouts.app') {{-- sesuaikan dengan layout Anda --}}

@section('content')
    <!-- Hero Banner -->
    <div class="relative text-center text-white py-16 mb-8 bg-cover bg-center"
        style="background-image: url('{{ asset('images/bg-mental.jpg') }}')">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10">
            <p class="mb-2 text-lg">Kesehatan Mental</p>
            <h2 class="text-3xl font-bold">Detail Artikel</h2>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <!-- Konten Utama -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-5 mb-6">
                <img src="{{ asset('storage/' . $artikel->foto) }}" class="w-full h-80 object-cover rounded mb-4"
                    alt="{{ $artikel->judul }}">
                <h3 class="text-3xl font-bold mb-2">{{ $artikel->judul }}</h3>
                <p class="text-sm text-gray-500 mb-3">
                    <i class="bi bi-clock"></i> {{ $artikel->created_at->format('d M Y') }}
                </p>
                <div class="text-gray-700 leading-relaxed prose max-w-none">
                    {!! $artikel->deskripsi !!}
                </div>
            </div>
            <a href="{{ route('artikel.index') }}"
                class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                ← Kembali
            </a>
        </div>

        <!-- Sidebar: Artikel Terbaru -->
        <div>
            <div class="bg-white rounded-lg shadow p-4">
                <h5 class="font-bold mb-4 text-lg">Artikel Terbaru</h5>
                @foreach ($latest as $post)
                    <div class="flex items-center gap-4 mb-3">
                        <a href="{{ route('artikel.show', $post->id) }}">
                            <img src="{{ asset('storage/' . $post->foto) }}" class="w-20 h-16 object-cover rounded"
                                alt="{{ $post->judul }}">
                        </a>
                        <div class="space-y-1">
                            <a href="{{ route('artikel.show', $post->id) }}"
                                class="text-gray-800 font-semibold block hover:text-green-600">
                                {{ Str::limit($post->judul, 50) }}
                            </a>
                            <small class="text-gray-500">{{ $post->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
