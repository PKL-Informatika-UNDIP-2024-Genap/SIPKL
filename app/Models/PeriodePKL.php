<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodePKL extends Model
{
    use HasFactory;

    protected $table = 'periode_pkl';
    protected $primaryKey = 'id_periode';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public static function get_arr_recent_periode($years = 2){
        $periode = self::whereDate('tgl_mulai', '>=', Carbon::now()->subYears($years))
        ->orderByDesc('id_periode')
        ->pluck('id_periode')
        ->toArray();
        return $periode;
    }

    public static function get_arr_id_periode(){
        $periode = self::orderByDesc('id_periode')
        ->pluck('id_periode')
        ->toArray();
        return $periode;
    }

    public static function get_recent_periode(){
        $today = Carbon::now()->toDateString();
        
        $periode_pkl = PeriodePKL::select('id_periode')->whereDate('tgl_mulai', '<=', $today)
        ->whereDate('tgl_selesai', '>=', $today)
        ->orderBy('tgl_mulai', 'desc')
        ->first();
        return $periode_pkl;
    }

    public static function get_id_periode_sekarang(){
        $periode_pkl = self::get_recent_periode();
        return $periode_pkl->id_periode;
    }
}
