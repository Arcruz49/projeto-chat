<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CadStatusSolicitacao extends Model
{
    protected $table = 'cadStatusSolicitacao'; 

    protected $primaryKey = 'cdStatusSolicitacao';

    public $timestamps = false;

    protected $fillable = [
        'descStatus',
    ];

    
}
