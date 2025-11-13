<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'materia_id', 'dia', 'hora_inicio', 'hora_fin', 'aula', 'color',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
