<?php

namespace App\Filament\Widgets;

use App\Models\HasilDiagnosa; // Pastikan model ini ada
use App\Models\Rule; // <-- TAMBAHKAN IMPORT INI
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class DiagnosaKategoriChart extends ChartWidget
{
    protected static ?string $heading = 'Hasil Diagnosa';

    protected static ?int $sort = 1; 

    /**
     * Mengambil data untuk ditampilkan di chart.
     */
    protected function getData(): array
    {
        $activeFilter = $this->filter;

        // Query dasar untuk mengambil jumlah diagnosa per bulan
        $query = HasilDiagnosa::query()
            ->select(
                DB::raw('COUNT(*) as total'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_year") // Grup berdasarkan bulan dan tahun
            )
            ->whereYear('created_at', now()->year) // Ambil data tahun ini saja
            ->groupBy('month_year')
            ->orderBy('month_year', 'asc'); // Urutkan berdasarkan bulan

        // Terapkan filter kategori jika ada filter yang dipilih dan bukan 'all'
        if ($activeFilter && $activeFilter !== 'all') {
            $query->where('kategori', $activeFilter);
        }

        $data = $query->get();

        // Siapkan array untuk labels (bulan) dan values (jumlah)
        $labels = [];
        $values = [];

        // Loop 12 bulan untuk memastikan semua bulan ada di chart
        for ($i = 1; $i <= 12; $i++) {
            // Format bulan 'Y-m', cth: '2024-01'
            $month = now()->month($i)->format('Y-m');
            // Format label 'M', cth: 'Jan'
            $labels[] = now()->month($i)->format('M');

            // Cari data untuk bulan ini
            $monthData = $data->firstWhere('month_year', $month);

            // Jika ada data, masukkan totalnya. Jika tidak, masukkan 0.
            $values[] = $monthData ? $monthData->total : 0;
        }

        $label = $activeFilter && $activeFilter !== 'all' ? $activeFilter : 'Semua Kategori';

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah diagnosa (' . $label . ')',
                    'data' => $values,
                    'borderColor' => 'rgba(75, 192, 192, 1)', // Warna garis
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Warna area bawah garis
                    'fill' => true, // Isi area di bawah garis
                    'tension' => 0.1, // Bikin garis sedikit melengkung
                ],
            ],
            'labels' => $labels, // 'Jan', 'Feb', 'Mar', ...
        ];
    }

    /**
     * Mendefinisikan tipe chart.
     */
    protected function getType(): string
    {
        return 'line'; // Tipe chart: garis
    }

    /**
     * Membuat filter dropdown di atas chart.
     */
    protected function getFilters(): ?array
    {
        // Ambil semua kategori unik dari tabel 'rules'
        $categories = Rule::query() // <-- UBAH BAGIAN INI
                        ->select('kategori')
                        ->whereNotNull('kategori') 
                        ->where('kategori', '!=', '') // Menghindari string kosong
                        ->distinct()
                        ->pluck('kategori');

        // Ubah koleksi kategori menjadi array untuk filter
        // key = 'Nama Kategori', value = 'Nama Kategori'
        $filters = $categories->mapWithKeys(function ($cat) {
            return [$cat => $cat];
        })->toArray();

        // Tambahkan opsi 'Semua Kategori' di awal array
        return array_merge(['all' => 'Semua Kategori'], $filters);
    }
}