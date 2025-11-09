<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domicilio',
        'nombre_padre','telefono_padre','dni_padre',
        'nombre_madre','telefono_madre','dni_madre',
        'nombre_tutor','telefono_tutor','dni_tutor',
        'numero_emergencia',
        'personas_autorizadas',
        'bloqueado',
    ];

    protected $casts = [
        'personas_autorizadas' => 'array',
        'bloqueado' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
