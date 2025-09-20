<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsiJawaban extends Model
{
    protected $table = 'opsi_jawabans';

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
