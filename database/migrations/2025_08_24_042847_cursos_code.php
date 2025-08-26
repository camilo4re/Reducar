<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registration_codes', function (Blueprint $table) {
            // Rol del usuario que va a usar este código
            $table->enum('role', ['alumno', 'profesor', 'directivo'])->default('alumno');

            // Relación con curso (puede ser null si es un código global, ej: directivo)
            $table->foreignId('curso_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registration_codes', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropConstrainedForeignId('curso_id');
        });
    }
};
