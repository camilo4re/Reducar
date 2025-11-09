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
        'curso_id', 
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

     public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function materias()
    {
        return $this->hasMany(Materia::class);
    }

    public function contenidos()
    {
        return $this->hasMany(Contenido::class);
    }

    public function getRoleAttribute($value)
    {
        return $value;
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
    public function profile()
{
    return $this->hasOne(UserProfile::class);
}
}
