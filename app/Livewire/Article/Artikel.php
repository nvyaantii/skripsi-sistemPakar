<?php

namespace App\Http\Livewire\Article;

use Livewire\Component;
use App\Models\Artikel as ArtikelModel; // pakai alias supaya tidak bentrok

class Artikel extends Component
{
    public $artikels;
    public $selectedArtikel = null;

    public function mount()
    {
        $this->artikels = ArtikelModel::orderBy('tanggal', 'desc')->get();
    }

    public function viewArtikel($id)
    {
        $this->selectedArtikel = ArtikelModel::find($id);
    }

    public function render()
    {
        return view('livewire.article.artikel');
    }
}
