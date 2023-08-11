<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'data_submissao', 'data_inicio_estagio'];

    public function tipoExpediente()
    {
        return $this->belongsTo(TipoExpediente::class);
    }

    public function estagioProcesso()
    {
        return $this->belongsTo(EstagioProcesso::class);
    }

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionario_comentario_expediente')
            ->withPivot('comentario', 'data_comentario');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

}
