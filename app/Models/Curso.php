<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function materias()
    {
        return $this->hasMany(Materia::class);
    }
    public function alumnos()
{
    return $this->hasMany(User::class);
}
    
}