<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiLain extends Model
{
    use HasFactory;

    protected $table = 'informasi_lain';
    protected $primaryKey = 'id';
    // protected $keyType = 'string';
    // public $incrementing = false;
    public $timestamps = true;
    protected $guarded = [];

    public static function get_data_informasi_lain(){
        $data_informasi_lain = self::select(['id','nama','value'])->get();
        return $data_informasi_lain;
    }
}
