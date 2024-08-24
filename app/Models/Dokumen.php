<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';
    protected $primaryKey = 'id';
    // protected $keyType = 'string';
    // public $incrementing = false;
    public $timestamps = true;
    protected $guarded = [];

    public static function get_data_dokumen(){
        $data_dokumen = self::select(['id','deskripsi','lampiran','updated_at'])->get();
        return $data_dokumen;
    }
}
