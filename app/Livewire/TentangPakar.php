<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pakar;

class TentangPakar extends Component
{
    public function render()
    {
        // Ambil 1 data pakar (misalnya data pertama di tabel)
        $pakar = Pakar::first();

        return view('livewire.tentang-pakar', [
            'pakar' => $pakar,
        ])->layout('layouts.app'); // supaya ikut navbar & footer
    }
}
