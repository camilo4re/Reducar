<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioMateria extends Model
{
    protected $table = 'horarios_materias'; 
    
    protected $fillable = ['materia_id', 'dia_semana', 'hora_inicio', 'hora_fin'];

    public function materia()
    {
     return $this->belongsTo(Materia::class);
    }

}