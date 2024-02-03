<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPembimbing extends Model
{
    use HasFactory;

    protected $table = 'dosen_pembimbing';
    // protected $primaryKey = 'id';
    // protected $keyType = 'int';
    // public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];
}
