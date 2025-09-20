<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Home\HasilDiagnosa; // ✅ pakai namespace sesuai folder
use Illuminate\Support\Facades\DB;

class DiagnosaKategoriChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Kategori Diagnosa';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $rows = HasilDiagnosa::select('kategori', DB::raw('COUNT(*) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Diagnosa per Kategori',
                    'data' => array_values($rows),
                ],
            ],
            'labels' => array_keys($rows),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
