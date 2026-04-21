<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'user_id', 'user_id');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'user_id', 'user_id');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getNameAttribute()
    {
        return $this->nama;
    }

    public function isAdmin()
    {
        return strtolower($this->level->level_nama) === 'admin';
    }

    public function isKasir()
    {
        return strtolower($this->level->level_nama) === 'kasir';
    }

    public static function isAdminUser(): bool
    {
        $user = Auth::user();

        if (! $user instanceof self) {
            return false;
        }

        return $user->isAdmin();
    }
}