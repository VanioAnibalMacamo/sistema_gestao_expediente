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

}
