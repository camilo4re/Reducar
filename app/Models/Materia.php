<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{

    protected $fillable = ['nombre', 'curso_id', 'user_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
