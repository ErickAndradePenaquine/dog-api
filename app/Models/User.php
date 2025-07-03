<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Usado para identificar qual chave primaria da tabela usará o token
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Aqui eu poderia gerenciar permissões de usuario
    public function getJWTCustomClaims()
    {
        return [];
    }
}
