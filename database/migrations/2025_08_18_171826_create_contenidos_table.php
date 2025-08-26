<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('contenidos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('materia_id');
        $table->unsignedBigInteger('user_id'); // el profesor que crea el contenido
        $table->string('titulo');
        $table->text('descripcion')->nullable();
        $table->timestamps();

        // Relaciones
        $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenidos');
    }
};
