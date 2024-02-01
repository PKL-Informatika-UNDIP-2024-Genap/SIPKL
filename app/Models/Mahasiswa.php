<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    // Relasi antar tabel
    public function dosen_pembimbing(){
        return $this->hasOne(DosenPembimbing::class,'nip','nip_dospem');
    }

    public function pkl(){
        return $this->hasOne(PKL::class,'nim','nim');
    }

    public function seminar_pkl(){
        return $this->hasOne(SeminarPKL::class,'nim','nim');
    }
}
