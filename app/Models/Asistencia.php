<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\HorarioMateria;

class Asistencia extends Model
{
    protected $fillable = [
        'user_id',
        'materia_id', 
        'fecha',
        'estado',
        'observaciones'
    ];

    protected $casts = [
        'fecha' => 'date'
    ];


    public function alumno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public static function porcentajeAsistencia($user_id, $materia_id)
    {
        // Contar todas las asistencias del alumno en esa materia
        $total = self::where('user_id', $user_id)
                     ->where('materia_id', $materia_id)
                     ->count();

        // Si no tiene ninguna asistencia, devolver 0
        if ($total == 0) {
            return 0;
        }

        // Contar cuántas veces estuvo presente o justificado
        $presentes = self::where('user_id', $user_id)
                        ->where('materia_id', $materia_id)
                        ->whereIn('estado', ['presente', 'justificada'])
                        ->count();

        // Calcular el porcentaje
        $porcentaje = ($presentes / $total) * 100;
        
        // Redondear a 1 decimal
        return round($porcentaje, 1);
    }

    // Generar las fechas del mes según el horario de la materia
    public static function generarFechasDelMes($year, $month, $materia_id)
    {
        // Si no vienen el año o mes, usar el actual
        $year = $year ?: date('Y');
        $month = $month ?: date('m');
        
        // Buscar qué días de la semana tiene clase esta materia
        $diasConHorario = HorarioMateria::where('materia_id', $materia_id)
                                ->pluck('dia_semana')
                                ->unique()
                                ->toArray();

        // Si no hay horario configurado, devolver array vacío
        if (empty($diasConHorario)) {
            return []; 
        }

        // Calcular cuántos días tiene el mes
        $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        $fechas = [];

        // Recorrer cada día del mes
        for ($dia = 1; $dia <= $diasEnMes; $dia++) {
            // Crear la fecha
            $fecha = Carbon::createFromDate($year, $month, $dia);
            
            // Si ese día de la semana tiene clase, agregarlo
            // $fecha->dayOfWeek devuelve: 0=domingo, 1=lunes, 2=martes, etc.
            if (in_array($fecha->dayOfWeek, $diasConHorario)) {
                $fechas[] = $fecha->format('Y-m-d');
            }
        }
        
        return $fechas;
    }
}