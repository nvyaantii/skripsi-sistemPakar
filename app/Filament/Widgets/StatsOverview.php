<?php

namespace App\Filament\Widgets;

use App\Models\Gejala;
use App\Models\HasilDiagnosa;
use App\Models\Rule;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB; 

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    // Atur urutan, misal 0 agar di paling atas

    /**
     * Helper function untuk mengambil jumlah diagnosa per hari 
     * selama N hari terakhir.
     */
    protected function getDiagnosaTrendData(int $days = 7): array
    {
        // Tentukan tanggal mulai (misal, 7 hari yang lalu)
        $startDate = now()->subDays($days - 1)->startOfDay();

        // Mengambil data jumlah diagnosa per hari dari tabel hasil_diagnosa
        $data = HasilDiagnosa::query()
            ->select(
                DB::raw('DATE(created_at) as date_only'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', $startDate) // Filter hanya N hari terakhir
            ->groupBy('date_only')
            ->orderBy('date_only', 'asc')
            ->get();

        // Siapkan array untuk N hari terakhir, isi dengan 0 jika tidak ada data
        $trendData = [];
        
        // Loop dari 7 hari lalu hingga hari ini
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            
            // Cari data di collection. Jika tidak ada, count-nya 0.
            $count = $data->firstWhere('date_only', $date)['total'] ?? 0;
            $trendData[] = $count;
        }

        return $trendData;
    }

    protected function getStats(): array
    {
        $diagnosaTrend = $this->getDiagnosaTrendData(7);

        return [
            Stat::make('Total Diagnosa', HasilDiagnosa::count())
                ->description('Jumlah total diagnosa yang masuk')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('success')
                ->chart($diagnosaTrend), 

            Stat::make('Total Gejala', Gejala::count())
                ->description('Jumlah gejala yang terdaftar')
                ->descriptionIcon('heroicon-m-beaker')
                ->color('warning'),

            Stat::make('Total Kategori', Rule::count())
                ->description('Jumlah kategori hasil diagnosa')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
        ];
    }
}