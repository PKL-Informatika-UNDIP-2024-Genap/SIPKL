<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CetakSK extends Model
{
    use HasFactory;
    protected $table = 'cetak_sk';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
}
