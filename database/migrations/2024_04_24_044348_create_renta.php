
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenta extends Migration
{
    public function up()
    {
        Schema::create('rentas', function (Blueprint $table) {
            $table->id();
            $table->string('periodo');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->foreignId('user_id')->nullable()
                ->constrained()
                ->onDelete('cascade'); // Cambiado a cascade
            $table->foreignId('domicilio_id')->nullable()
                ->constrained()
                ->onDelete('cascade'); // Cambiado a cascade
            $table->foreignId('departamento_id')->nullable()
                ->constrained()
                ->onDelete('cascade'); // Cambiado a cascade
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('rentas');
    }
}
