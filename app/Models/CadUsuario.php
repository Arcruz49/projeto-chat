<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;  // Importe a interface

class CadUsuario extends Authenticatable implements JWTSubject  // Implemente a interface JWTSubject
{
    use HasFactory;

    protected $table = 'cadUsuario';
    protected $primaryKey = 'cdUsuario'; // Defina explicitamente o campo da chave primária

    protected $fillable = [
        'nmUsuario',
        'sobrenomeUsuario',
        'email',
        'senha',
        'dtCriacao',
        'imagemPerfil',
        'biografia'

    ];

    public $timestamps = false;

    // Método necessário para JWT: Retorna a chave primária do usuário
    public function getJWTIdentifier()
    {
        return $this->getKey();  // Retorna a chave primária do usuário
    }

    // Método necessário para JWT: Adiciona claims personalizadas, se necessário
    public function getJWTCustomClaims()
    {
        return [];  // Aqui você pode adicionar claims personalizadas, se necessário
    }
}
