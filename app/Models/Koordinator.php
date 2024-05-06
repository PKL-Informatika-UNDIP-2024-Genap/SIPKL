<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    use HasFactory;

    protected $table = 'koordinator';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    
    public static function update_email($email) {
        auth()->user()->koordinator()->update([
            'email' => $email,
        ]);
    }

    public static function update_golongan($golongan) {
        auth()->user()->koordinator()->update([
            'golongan' => $golongan,
        ]);
    }

    public static function update_jabatan($jabatan) {
        auth()->user()->koordinator()->update([
            'jabatan' => $jabatan,
        ]);
    }
}
