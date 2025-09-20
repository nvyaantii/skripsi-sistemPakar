<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;

class DiagnosaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil step dari query parameter (?step=1), default = 1
        $step = $request->get('step', 1);

        // Hitung total pertanyaan (dari tabel Gejala)
        $totalSteps = Gejala::count();

        // Ambil pertanyaan sesuai step
        $pertanyaan = Gejala::skip($step - 1)->first();

        // Kirim data ke view
        return view('livewire.diagnosa', compact('step', 'totalSteps', 'pertanyaan'));
    }
}
