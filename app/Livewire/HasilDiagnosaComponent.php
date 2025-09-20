<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rule;

class HasilDiagnosaComponent extends Component
{
    public $totalSkor;
    public $rule;

    public function mount()
    {
        $jawaban = session('jawaban', []);
        $this->totalSkor = array_sum($jawaban);

        $this->rule = Rule::where('min', '<=', $this->totalSkor)
                          ->where('max', '>=', $this->totalSkor)
                          ->first();
    }

    public function render()
    {
        return view('livewire.hasil-diagnosa')
            ->layout('layouts.app');
    }
}
