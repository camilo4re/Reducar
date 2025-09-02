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
    Schema::create('notas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
        $table->decimal('valor', 5, 2);
        $table->string('tipo')->nullable(); // Eliminalo si no lo querés
        $table->enum('periodo', ['primer_cuatrimestre', 'segundo_cuatrimestre', 'recuperatorio']);
        $table->string('trabajo_titulo', 100);
        $table->text('trabajo_descripcion')->nullable();
        $table->timestamps();
    });
}

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            //
        }
    };
