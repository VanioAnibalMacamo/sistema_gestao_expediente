<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstagioProcesso extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'data_submissao', 'data_inicio_estagio'];


    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    public function estagioProcessoPai()
    {
        return $this->belongsTo(EstagioProcesso::class, 'parent_estagio_processo_id');
    }

    public function estagioProcessoFilho()
    {
        return $this->hasOne(EstagioProcesso::class, 'parent_estagio_processo_id');
    }

    public function getEstagiosDisponiveis()
    {
        // Obtém todos os estágios do processo que não são sucessores de outros estágios
        $estagiosDisponiveis = EstagioProcesso::whereDoesntHave('estagioProcessoPai')->get();

        return $estagiosDisponiveis;
    }

    public function tipoExpedientes()
    {
        return $this->belongsToMany(TipoExpediente::class, 'estagio_processo_tipo_expediente');
    }

}
