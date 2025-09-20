<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejalas';

    public function opsiJawaban()
    {
        return $this->hasMany(OpsiJawaban::class, 'gejala_id');
    }
}
