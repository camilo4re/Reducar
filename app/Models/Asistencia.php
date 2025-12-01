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
        $total = self::where('user_id', $user_id)
                     ->where('materia_id', $materia_id)
                     ->count();

        if ($total == 0) {
            return 0;
        }

        $presentes = self::where('user_id', $user_id)
                        ->where('materia_id', $materia_id)
                        ->whereIn('estado', ['presente', 'justificada'])
                        ->count();

        $porcentaje = ($presentes / $total) * 100;
        
        return round($porcentaje, 1);
    }

    public static function generarFechasDelMes($year, $month, $materia_id)
    {
        $year = $year ?: date('Y');
        $month = $month ?: date('m');
        
        $diasConHorario = HorarioMateria::where('materia_id', $materia_id)
                                ->pluck('dia_semana')
                                ->unique()
                                ->toArray();

        if (empty($diasConHorario)) {
            return []; 
        }

        $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        $fechas = [];

        for ($dia = 1; $dia <= $diasEnMes; $dia++) {
            $fecha = Carbon::createFromDate($year, $month, $dia);
            
            if (in_array($fecha->dayOfWeek, $diasConHorario)) {
                $fechas[] = $fecha->format('Y-m-d');
            }
        }
        
        return $fechas;
    }
}