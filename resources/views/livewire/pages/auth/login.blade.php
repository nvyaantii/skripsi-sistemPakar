@extends('layouts.guest')

@section('content')
<div class="max-w-md mx-auto mt-20 p-8 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    <!-- Session Status -->
    @if(session('status'))
        <div class="mb-4 text-green-600 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm text-gray-600 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm text-gray-600 mb-1">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-4">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-300 text-green-600 focus:ring-green-500">
            <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <button type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Login</button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                    Forgot your password?
                </a>
            @endif
        </div>

        <!-- Register Link -->
        <p class="mt-6 text-center text-sm">
            Belum punya akun? <a href="{{ route('register') }}" class="text-green-600 hover:underline">Register</a>
        </p>
    </form>
</div>
@endsection
