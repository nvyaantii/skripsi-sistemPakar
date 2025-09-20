<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\HasilDiagnosa; // 🔥 ini tanpa "Home"

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke riwayat diagnosa
     * Satu user bisa punya banyak diagnosa
     */
    public function hasilDiagnosas()
    {
        return $this->hasMany(HasilDiagnosa::class, 'user_id');
    }
}
