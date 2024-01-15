<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarPKL extends Model
{
    use HasFactory;

    protected $table = 'seminar_pkl';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected $guarded = [];

    // Relasi antar tabel
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class,'nim','nim');
    }
}
