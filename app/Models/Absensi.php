<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'attendance';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'jam_masuk',
        'jam_keluar',
        'status', // Contoh kolom tambahan jika ada
    ];

    // Timestamps untuk created_at dan updated_at
    public $timestamps = true;

    // Relasi ke model User (asumsi setiap absensi terkait dengan pengguna)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
