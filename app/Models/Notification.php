<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['curso_id', 'materia_id', 'titulo', 'descripcion', 'fecha', 'prioridad'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
