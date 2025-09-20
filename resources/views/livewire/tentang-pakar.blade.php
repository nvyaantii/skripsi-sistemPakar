<div class="bg-white py-24">
    <div class="container mx-auto px-6 max-w-6xl">
        <h2 class="text-3xl font-bold text-green-700 mb-12 text-center">
            Tentang Pakar
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            {{-- Bagian Info --}}
            <div class="text-gray-800 space-y-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $pakar->foto) }}" 
                         alt="{{ $pakar->nama }}" 
                         class="w-16 h-16 rounded-full object-cover shadow-lg border border-gray-300">
                    <div>
                        <h3 class="text-xl font-semibold text-green-700">{{ $pakar->nama }}</h3>
                        <p class="text-sm text-gray-600">{{ $pakar->deskripsi }}</p>
                    </div>
                </div>

                <p class="text-base leading-relaxed">
                    Banyak orang belum sadar bahwa gangguan mental bisa dialami siapa saja. 
                    Dalam upaya <span class="font-semibold text-green-700">DepresQ</span> ini sangat mendorong menyebarkan 
                    edukasi bagi masyarakat.
                </p>

                <p class="text-sm font-medium mt-6">
                    <span class="opacity-80">Jadwal Praktik:</span> {{ $pakar->jam_praktek }}
                </p>
            </div>

            {{-- Foto besar --}}
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $pakar->foto) }}" 
                     alt="{{ $pakar->nama }}" 
                     class="rounded-2xl shadow-lg object-cover"
                     style="width: 200px; height: auto;">
            </div>
        </div>
    </div>
</div>
