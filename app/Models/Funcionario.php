<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'morada', 'email', 'contacto', 'genero','num_bi'];

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'funcionario_departamento_cargo', 'funcionario_id', 'departamento_id')
            ->withPivot('cargo_id')
            ->withTimestamps();
    }

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'funcionario_departamento_cargo', 'funcionario_id', 'cargo_id')
            ->withPivot('departamento_id')
            ->withTimestamps();
    }
}
