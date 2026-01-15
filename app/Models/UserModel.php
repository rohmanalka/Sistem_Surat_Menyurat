<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SuratModel;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'nama',
        'divisi',
        'jabatan',
        'email',
        'password',
        'role',
    ];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function surat() : HasMany
    {
        return $this->hasMany(SuratModel::class);
    }
}