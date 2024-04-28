<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    // protected $keyType = 'string';
    // public $incrementing = false;
    public $timestamps = true;
    protected $guarded = [];

    public static function get_data_pengumuman(){
        $data_pengumuman = self::select(['deskripsi','lampiran','updated_at'])->get();
        return $data_pengumuman;
    }
}
