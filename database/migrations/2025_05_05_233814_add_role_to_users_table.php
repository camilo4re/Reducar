<?php

public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['alumno', 'maestro', 'director'])->default('alumno')->after('email');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}
