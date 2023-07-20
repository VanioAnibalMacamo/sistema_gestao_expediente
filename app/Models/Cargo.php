<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = ['nome','descricao'];

    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionario_departamento_cargo', 'cargo_id', 'funcionario_id')
            ->withPivot('departamento_id')
            ->withTimestamps();
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'funcionario_departamento_cargo', 'cargo_id', 'departamento_id')
            ->withPivot('funcionario_id')
            ->withTimestamps();
    }
}
