<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model{

use HasFactory;

protected $fillable=['nome','sigla'];


public function estudante()
{
    return $this->belongsTo(Estudante::class);

}

public function user()
{
    return $this->belongsTo(User::class);
}

}