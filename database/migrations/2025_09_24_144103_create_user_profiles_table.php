<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('domicilio');

            // Padre
            $table->string('nombre_padre')->nullable();
            $table->string('telefono_padre')->nullable();
            $table->string('dni_padre')->nullable();

            // Madre
            $table->string('nombre_madre')->nullable();
            $table->string('telefono_madre')->nullable();
            $table->string('dni_madre')->nullable();

            // Tutor
            $table->string('nombre_tutor')->nullable();
            $table->string('telefono_tutor')->nullable();
            $table->string('dni_tutor')->nullable();

            // Emergencia
            $table->string('numero_emergencia');

            // Personas autorizadas: array de objetos [{nombre, dni, telefono}, ...]
            $table->json('personas_autorizadas')->nullable();

            // Control de edición: true = bloqueado (no editable por el usuario)
            $table->boolean('bloqueado')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
