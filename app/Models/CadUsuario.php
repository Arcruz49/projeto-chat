<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CadUsuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'cadUsuario';

    protected $fillable = [
        'nmUsuario',
        'sobrenomeUsuario',
        'email',
        'senha',
        'dtCriacao',
    ];

    public $timestamps = false;  
}
