<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Imports\UsersImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'username';
    public $timestamps = true;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi antar tabel
    public function koordinator()
    {
        return $this->hasOne(Koordinator::class,'id','username');
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class,'nim','username');
    }

    public function update_password($password_baru){
        $this->update([
            'password' => Hash::make($password_baru),
        ]);
    }

    public static function reset_password($username){
        $user = self::where('username', $username)->update([
            'password' => Hash::make($username),
        ]);
    }

    public static function import($file){
        $importUsers = new UsersImport();
        $importUsers->import($file);

        $error_row = [];
        $error_message = [];
        foreach ($importUsers->failures() as $failure) {
            array_push($error_row, $failure->row());
            array_push($error_message, $failure->errors());
        }

        return [
            'error_row' => $error_row,
            'error_message' => $error_message,
        ];
    }
}
