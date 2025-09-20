<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HasilDiagnosa;


class RiwayatDiagnosaController extends Controller
{
    public function index()
    {
        $riwayat = HasilDiagnosa::where('user_id', Auth::id())->get();
        return view('riwayat-diagnosa', compact('riwayat'));
    }
}
