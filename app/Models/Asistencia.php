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

    public static function estadosDisponibles()
    {
        return [
            'presente' => 'Presente',
            'ausente' => 'Ausente', 
            'tardanza' => 'Tardanza',
            'justificada' => 'Justificada'
        ];
    }

    public static function porcentajeAsistencia($user_id, $materia_id)
    {
        $total = self::where('user_id', $user_id)
                     ->where('materia_id', $materia_id)
                     ->count();

        if ($total == 0) return 100;

        $presentes = self::where('user_id', $user_id)
                        ->where('materia_id', $materia_id)
                        ->whereIn('estado', ['presente', 'justificada'])
                        ->count();

        return round(($presentes / $total) * 100, 1);
    }

    // ✅ MÉTODO MODIFICADO: Ahora recibe materia_id y filtra por horarios
    public static function generarFechasDelMes($year = null, $month = null, $materia_id = null)
    {
        $year = $year ?: date('Y');
        $month = $month ?: date('m');
        
        $fechas = [];
        $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        // Si no se proporciona materia_id, usar el método anterior
        if (!$materia_id) {
            for ($dia = 1; $dia <= $diasEnMes; $dia++) {
                $fecha = Carbon::createFromDate($year, $month, $dia);
                if ($fecha->isWeekday()) {
                    $fechas[] = $fecha->format('Y-m-d');
                }
            }
            return $fechas;
        }

        // ✅ CORREGIDO: Usar la tabla correcta y dia_semana como número
        $diasConHorario = HorarioMateria::where('materia_id', $materia_id)
                                ->pluck('dia_semana')
                                ->unique()
                                ->toArray();

        if (empty($diasConHorario)) {
            return []; // Si no hay horarios, no hay fechas
        }

        // Generar fechas solo para los días que tienen horario
        for ($dia = 1; $dia <= $diasEnMes; $dia++) {
            $fecha = Carbon::createFromDate($year, $month, $dia);
            
            // Carbon: 1=lunes, 2=martes... 7=domingo
            // Tu modelo: 1=lunes, 2=martes... 7=domingo (igual)
            // Solo incluir si el día de la semana está en los horarios
            if (in_array($fecha->dayOfWeek, $diasConHorario)) {
                $fechas[] = $fecha->format('Y-m-d');
            }
        }
        
        return $fechas;
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}