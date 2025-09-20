<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DepresQ') }}</title>

    {{-- Vite bawaan Breeze --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-gray-50 text-gray-900">

    {{-- Navbar --}}
    @include('livewire.footer_navbar.navbar') 

    {{-- Main Content --}}
    <main class="min-h-screen py-6">
        @isset($slot)
            {{ $slot }}   {{-- dipakai oleh Livewire --}}
        @else
            @yield('content') {{-- dipakai oleh view biasa --}}
        @endisset
    </main>

    {{-- Footer --}}
    @include('livewire.footer_navbar.footer')

    @livewireScripts
</body>
</html>
