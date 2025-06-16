<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadMensagem extends Model
{

    protected $table = 'cadMensagem';
    protected $primaryKey = 'cdMensagem'; 

    protected $fillable = [
        'cdUsuarioEnvio',
        'cdUsuarioRecebeu',
        'visualizado',
        'descMensagem',
        'dtEnvio'
    ];

    public $timestamps = false;

    public function cdUsuarioEnvio()
    {
        return $this->belongsTo(CadUsuario::class, 'cdUsuarioEnvio');
    }

    public function cdUsuarioRecebeu()
    {
        return $this->belongsTo(CadUsuario::class, 'cdUsuarioRecebeu');
    }
}
