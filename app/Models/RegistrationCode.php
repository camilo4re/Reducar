<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'used',
        'role',
        'curso_id',
    ];

  
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function usable()
    {
        return !$this->used && !$this->user_id;
    }
}
