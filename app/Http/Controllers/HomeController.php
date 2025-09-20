<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil artikel terbaru
        $artikels = Artikel::orderBy('created_at', 'desc')->take(3)->get();

        // arahkan ke view sesuai folder
        return view('livewire.home.home', compact('artikels'));
    }
}
