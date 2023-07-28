<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $deletablePermissions = ['Cadastrar', 'Editar', 'Visualizar', 'Apagar'];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($permission) {
            if (in_array($permission->name, $permission->deletablePermissions)) {
                return false;
            }
        });
    }
}
