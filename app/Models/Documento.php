<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = ['nome_unico', 'nome_original'];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}
