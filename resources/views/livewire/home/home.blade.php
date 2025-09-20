@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-6xl">
    {{-- Hero Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-12">
        <div>
            <h1 class="text-4xl font-bold text-green-700 mb-4">
                Selamat Datang di Sistem Pakar Deteksi Depresi
            </h1>
            <p class="text-gray-700 mb-6 leading-relaxed">
                Temukan informasi seputar kesehatan mental, lakukan diagnosa depresi berbasis BDI, 
                dan dapatkan saran untuk menjaga kesejahteraan Anda.
            </p>
            <a href="#"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
               Mulai Diagnosa
            </a>
        </div>
        <div>
            <img src="{{ asset('assets/images/depresi home.png') }}" 
                 alt="Kesehatan Mental" 
                 class="rounded-lg shadow-md">
        </div>
    </div>

   {{-- Artikel Section --}}
   <div>
        <h2 class="text-2xl font-semibold text-green-700 mb-6">Artikel Terbaru</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> 
            @foreach($artikels as $artikel)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition flex flex-col">
                    <img src="{{ asset('storage/' . $artikel->foto) }}" 
                         alt="{{ $artikel->judul }}" 
                         class="rounded-t-lg h-40 w-full object-cover">
                    <div class="p-4 flex flex-col flex-1">
                        {{-- Judul Artikel Bold & Lebih Kecil --}}
                        <h3 class="text-base font-bold mb-2 text-gray-900 leading-snug">
                            {{ $artikel->judul }}
                        </h3>
                        {{-- Deskripsi Lebih Ringan & Dibatasi --}}
                        <p class="text-gray-600 text-sm mb-3 flex-1 line-clamp-3 leading-relaxed">
                            {{ Str::limit($artikel->deskripsi, 120) }}
                        </p>
                        <a href="#"
                           class="mt-auto text-green-600 hover:underline text-sm font-medium">
                           Baca Selengkapnya 
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- FAQ Section --}}
    <div class="mt-16">
        <h2 class="text-2xl font-semibold text-green-700 mb-6 text-center">
            FAQ (Pertanyaan yang Sering Diajukan)
        </h2>

        <div class="bg-white rounded-xl shadow-md p-6 divide-y divide-gray-200 max-w-3xl mx-auto">
            <div x-data="{ open: null }">

                {{-- FAQ 1 --}}
                <div>
                    <button @click="open === 1 ? open = null : open = 1" 
                            class="flex justify-between items-center w-full py-4 text-left font-medium text-gray-800 hover:text-green-600 transition">
                        Apa itu Sistem Pakar Deteksi Depresi?
                        <span :class="open === 1 ? 'rotate-180 text-green-600' : ''" class="transition-transform">⌄</span>
                    </button>
                    <div x-show="open === 1" x-collapse class="pb-4 text-gray-600 text-sm leading-relaxed">
                        Sistem ini membantu mendeteksi tingkat depresi menggunakan metode BDI (Beck Depression Inventory) 
                        dan memberikan saran untuk menjaga kesehatan mental.
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div>
                    <button @click="open === 2 ? open = null : open = 2" 
                            class="flex justify-between items-center w-full py-4 text-left font-medium text-gray-800 hover:text-green-600 transition">
                        Apakah hasil diagnosa ini bisa menggantikan dokter?
                        <span :class="open === 2 ? 'rotate-180 text-green-600' : ''" class="transition-transform">⌄</span>
                    </button>
                    <div x-show="open === 2" x-collapse class="pb-4 text-gray-600 text-sm leading-relaxed">
                        Tidak. Hasil diagnosa hanya berupa indikasi awal. 
                        Untuk diagnosa lebih akurat, tetap disarankan berkonsultasi dengan psikolog atau psikiater.
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div>
                    <button @click="open === 3 ? open = null : open = 3" 
                            class="flex justify-between items-center w-full py-4 text-left font-medium text-gray-800 hover:text-green-600 transition">
                        Apakah data saya aman?
                        <span :class="open === 3 ? 'rotate-180 text-green-600' : ''" class="transition-transform">⌄</span>
                    </button>
                    <div x-show="open === 3" x-collapse class="pb-4 text-gray-600 text-sm leading-relaxed">
                        Ya. Data yang Anda masukkan akan dijaga kerahasiaannya dan hanya digunakan untuk kepentingan diagnosa.
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
