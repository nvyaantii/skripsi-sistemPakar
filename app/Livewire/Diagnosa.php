<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Gejala;

class Diagnosa extends Component
{
    public $step = 1;
    public $totalSteps;
    public $jawaban = [];
    public $jawabanSementara = null;

    public function mount()
    {
        $this->totalSteps = Gejala::count();
    }

    public function pilihJawaban($skor)
    {
        $this->jawabanSementara = (int) $skor;
    }

    public function nextStep()
    {
        if ($this->jawabanSementara !== null) {
            $this->jawaban[$this->step] = $this->jawabanSementara;
        }

        if ($this->step < $this->totalSteps) {
            $this->step++;
            $this->jawabanSementara = null;
        } else {
            
            session(['jawaban' => $this->jawaban]);
            return redirect()->route('hasil.diagnosa');
        }
    }

    public function render()
    {
        $pertanyaan = Gejala::with('opsiJawaban')
            ->orderBy('id', 'asc')
            ->skip($this->step - 1)
            ->take(1)
            ->first();

        // Debug log biar kita tahu datanya bener masuk
        logger()->info('Step sekarang: '.$this->step);
        logger()->info('Pertanyaan:', [$pertanyaan]);

        return view('livewire.diagnosa', [
            'pertanyaan' => $pertanyaan,
            'step' => $this->step,
            'totalSteps' => $this->totalSteps,
        ])->layout('layouts.app');
    }
}
