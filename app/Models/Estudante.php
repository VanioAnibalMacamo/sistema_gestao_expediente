<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    use HasFactory;

    protected $fillable = ['nome','apelido','curso','codigo','contacto','morada'];

    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }
}
