<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'curso_id', // AGREGADO
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación con curso
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    // Relación con notas (como alumno)
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    // Relación con materias que creó (como profesor)
    public function materias()
    {
        return $this->hasMany(Materia::class);
    }

    // Relación con contenidos que creó
    public function contenidos()
    {
        return $this->hasMany(Contenido::class);
    }

    public function getRoleAttribute($value)
    {
        return $value;
    }
}
