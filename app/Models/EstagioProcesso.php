<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstagioProcesso extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'tempo_estimado_conclusao'];

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

}
