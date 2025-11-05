<?php

namespace App\Http\Livewire\Article;

use Livewire\Component;
use App\Models\Artikel; // kalau kamu pakai model Artikel

class Detail extends Component
{
    public $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.article.detail');
    }
}
