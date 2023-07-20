<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = ['nome','descricao','sigla'];

    public function tiposExpediente()
    {
        return $this->hasMany(TipoExpediente::class);
    }

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionario_departamento_cargo', 'departamento_id', 'funcionario_id')
            ->withPivot('cargo_id')
            ->withTimestamps();
    }

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'funcionario_departamento_cargo', 'departamento_id', 'cargo_id')
            ->withPivot('funcionario_id')
            ->withTimestamps();
    }

}
