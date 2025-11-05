<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rule;
use App\Models\HasilDiagnosa;
use Illuminate\Support\Facades\Auth;

class HasilDiagnosaComponent extends Component
{
    public $totalSkor;
    public $rule;

    public function mount()
    {
        $jawaban = session('jawaban', []);
        $this->totalSkor = array_sum($jawaban);

        // Ambil rule yang sesuai skor
        $this->rule = Rule::where('min', '<=', $this->totalSkor)
                          ->where('max', '>=', $this->totalSkor)
                          ->first();

        // ✅ Simpan hasil diagnosa ke database (hanya jika user login dan rule ditemukan)
        if (Auth::check() && $this->rule) {
            HasilDiagnosa::create([
                'user_id' => Auth::id(),
                'kategori' => $this->rule->kategori,
                'skor' => $this->totalSkor,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.hasil-diagnosa')
            ->layout('layouts.app');
    }
}
