@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Riwayat Diagnosa</h2>

    @if($riwayat->count() > 0)
        <ul class="divide-y divide-gray-200">
            @foreach($riwayat as $item)
                <li class="py-4">
                    <p class="font-semibold text-gray-700">Kategori: {{ $item->kategori }}</p>
                    <p class="text-gray-600">Skor: {{ $item->skor }}</p>
                    <p class="text-gray-500 text-sm">Tanggal: {{ $item->created_at->format('d M Y H:i') }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center text-gray-500">Belum ada riwayat diagnosa.</p>
    @endif
</div>
@endsection
