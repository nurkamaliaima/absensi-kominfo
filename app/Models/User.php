<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';
    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Menambahkan relasi absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
