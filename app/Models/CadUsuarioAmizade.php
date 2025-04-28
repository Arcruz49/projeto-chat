<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadUsuarioAmizade extends Model
{
    protected $table = 'cadusuario_Amizade'; 

    protected $primaryKey = 'cdusuario_Amizade'; 

    public $timestamps = false; 

    protected $fillable = [
        'cdUsuarioEnvioSolicitacao',
        'cdUsuarioRecebeuSolicitacao',
        'cdStatusSolicitacao',
        'dtEnvioSolicitacao',
        'dtRespostaSolicitacao',
    ];
    
    public function status()
    {
        return $this->belongsTo(CadStatusSolicitacao::class, 'cdStatusSolicitacao');
    }

    public function usuarioEnvio()
    {
        return $this->belongsTo(CadUsuario::class, 'cdUsuarioEnvioSolicitacao');
    }

    public function usuarioRecebimento()
    {
        return $this->belongsTo(CadUsuario::class, 'cdUsuarioRecebeuSolicitacao');
    }
}
