<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationCode extends Model
{
    protected $fillable = ['code', 'role', 'curso_id', 'used'];
    
    protected $casts = [
        'used' => 'boolean',
    ];
    
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}