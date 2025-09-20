<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'foto',
        'kategori_id', // tambahin kalau memang ada relasi
    ];

}