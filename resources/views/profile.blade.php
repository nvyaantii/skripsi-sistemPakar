@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">

    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Profile</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Info User --}}
    <div class="mb-6">
        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    </div>

    {{-- Form Edit Profile --}}
    <h3 class="text-xl font-semibold mb-4">Edit Profile</h3>
    <form method="POST" action="{{ route('profile.update') }}" class="mb-8 space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                   class="w-full border rounded-lg p-2 focus:ring focus:ring-green-300">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                   class="w-full border rounded-lg p-2 focus:ring focus:ring-green-300">
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1">Password (kosongkan jika tidak ganti)</label>
            <input type="password" name="password" class="w-full border rounded-lg p-2 focus:ring focus:ring-green-300">
            @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full border rounded-lg p-2 focus:ring focus:ring-green-300">
        </div>

        <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
            Simpan Perubahan
        </button>
    </form>

    {{-- Tombol Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="mt-8">
        @csrf
        <button type="submit"
            class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
            Logout
        </button>
    </form>
</div>
@endsection
