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
        Schema::create('registration_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();  // El código de inscripción
            $table->boolean('used')->default(false);  // Marca si el código ha sido usado
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('registration_codes');
    }
};
