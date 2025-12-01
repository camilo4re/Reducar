<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{

    protected $fillable = ['nombre', 'curso_id', 'user_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}

    
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function contenidos()
    {
    return $this->hasMany(Contenido::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
    public function horarios()
{
    return $this->hasMany(HorarioMateria::class);
}   
public function alumnos()
{
    return $this->belongsToMany(User::class, 'asistencias', 'materia_id', 'user_id')->distinct();
}

}
