<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Estudante extends Model
{
    use HasFactory;

    protected $fillable = ['nome','apelido','codigo','contacto','morada'];

    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    // Relacionamentos do modelo Student
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
