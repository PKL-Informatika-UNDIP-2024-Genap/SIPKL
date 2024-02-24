<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPKL extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pkl';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public static function bulk_create($arr_mhs){
        self::create($arr_mhs->get()->map(function($item){
            return [
                'nim' => $item->nim,
                'periode_pkl' => $item->periode_pkl,
                'status' => $item->status == 'Aktif' ? 'Tidak Lulus' : 'Nonaktif',
                'id_dospem' => $item->id_dospem,
            ];
        })->toArray());
    }
}
