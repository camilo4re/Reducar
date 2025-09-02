<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'user_id', 
        'materia_id', 
        'periodo', 
        'trabajo_titulo', 
        'trabajo_descripcion',
        'valor'
    ];

    // Relaciones
    public function alumno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    // Scopes para filtrar por periodo
    public function scopePrimerCuatrimestre($query)
    {
        return $query->where('periodo', 'primer_cuatrimestre');
    }

    public function scopeSegundoCuatrimestre($query)
    {
        return $query->where('periodo', 'segundo_cuatrimestre');
    }

    public function scopeRecuperatorio($query)
    {
        return $query->where('periodo', 'recuperatorio');
    }

    // Método para obtener trabajos únicos por periodo y materia
    public static function getTrabajosUnicos($materia_id, $periodo)
    {
        return self::where('materia_id', $materia_id)
                   ->where('periodo', $periodo)
                   ->select('trabajo_titulo', 'trabajo_descripcion')
                   ->distinct()
                   ->get();
    }

    // Método para calcular promedio por alumno y periodo
    public static function promedioAlumnoPeriodo($user_id, $materia_id, $periodo)
    {
        return self::where('user_id', $user_id)
                   ->where('materia_id', $materia_id)
                   ->where('periodo', $periodo)
                   ->avg('valor');
    }
}