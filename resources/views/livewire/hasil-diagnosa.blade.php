<div class="max-w-3xl mx-auto mt-16 p-6 bg-white shadow rounded text-center">
    <h2 class="text-2xl font-bold mb-4">Hasil Diagnosa</h2>

    {{-- Total skor --}}
    <div class="mb-6">
        <p class="text-gray-600">Total Skor Anda:</p>
        <p class="text-3xl font-bold text-green-600">{{ $totalSkor }}</p>
    </div>

    {{-- Jika ada rule yang cocok --}}
    @if($rule)
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Kategori Depresi</h3>
            <p class="text-lg font-bold text-red-600 mt-2">{{ $rule->kategori }}</p>
        </div>

        <div class="text-left bg-gray-50 p-4 rounded shadow">
            <h4 class="text-lg font-semibold mb-2">Saran Penanganan:</h4>
            <p class="text-gray-700 leading-relaxed">{{ $rule->saran }}</p>
        </div>
    @else
        <p class="text-gray-600">Tidak ada kategori yang cocok dengan skor Anda.</p>
    @endif

    

</div>
