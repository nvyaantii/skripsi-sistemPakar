<div class="max-w-3xl mx-auto mt-16 p-6 bg-white shadow rounded">
    @if($pertanyaan)
        <h2 class="text-lg font-bold mb-2">
            Pertanyaan {{ $step }} / {{ $totalSteps }}
        </h2>
        <p class="mb-4 text-gray-700">{{ $pertanyaan->pertanyaan }}</p>

        {{-- Kotak jawaban --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            @foreach($pertanyaan->opsiJawaban as $opsi)
                <div 
                    wire:click="pilihJawaban({{ $opsi->skor }})"
                    wire:key="opsi-{{ $opsi->id }}"
                    class="cursor-pointer p-4 rounded-lg border text-center font-medium transition duration-200
                           {{ $jawabanSementara === $opsi->skor
                                ? 'bg-green-600 text-white border-green-700 shadow-md scale-105 ring-2 ring-green-500' 
                                : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100' }}">
                    {{ $opsi->keterangan }}
                </div>
            @endforeach
        </div>

        {{-- Tombol Next --}}
        <div class="flex justify-end">
            <button 
                wire:click="nextStep"
                @disabled(is_null($jawabanSementara))
                class="px-5 py-2 rounded-lg font-medium
                       {{ $step < $totalSteps 
                            ? 'bg-green-600 hover:bg-green-700' 
                            : 'bg-blue-600 hover:bg-blue-700' }} 
                       text-white disabled:opacity-50 transition">
                {{ $step < $totalSteps ? 'Next' : 'Lihat Hasil' }}
            </button>
        </div>
    @else
        <p class="text-red-600">⚠️ Tidak ada pertanyaan ditemukan.</p>
    @endif
</div>
