<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'data_submissao'];

    public function tipoExpediente()
    {
        return $this->belongsTo(TipoExpediente::class);
    }

}
