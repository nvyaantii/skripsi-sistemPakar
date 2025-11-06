<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    // Halaman daftar artikel
    public function index()
    {
        $artikels = Artikel::latest()->paginate(6);

        return view('livewire.article.artikel', compact('artikels'));
    }

    // Halaman detail artikel
    public function show($id)
    {
        $artikel = Artikel::where('id', $id)->firstOrFail();
        $latest  = Artikel::latest()->take(5)->get(); // sidebar

        return view('livewire.article.detail', compact('artikel', 'latest'));
    }
}
