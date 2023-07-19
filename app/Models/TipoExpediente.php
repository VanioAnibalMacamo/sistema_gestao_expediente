<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoExpediente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];

    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function estagiosProcesso()
    {
        return $this->belongsToMany(EstagioProcesso::class, 'estagio_processo_tipo_expediente');
    }

}
