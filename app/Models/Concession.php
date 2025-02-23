<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concession extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'concession';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'reason',    // Alasan izin
        'description',
        'status',    // Status izin (disetujui, ditolak, dll.)
        'start_date', // Tanggal mulai izin
        'end_date',   // Tanggal berakhir izin
    ];

    // Timestamps untuk created_at dan updated_at
    public $timestamps = true;

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
