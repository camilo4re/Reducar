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
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); //fk a users
        $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade'); //fk a materias
        $table->decimal('valor'); 
        $table->enum('periodo', ['primer_cuatrimestre', 'segundo_cuatrimestre', 'intensificacion']);
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
