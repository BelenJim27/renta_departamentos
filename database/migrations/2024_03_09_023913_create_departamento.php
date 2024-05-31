<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamento extends Migration
{
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('imagen');
            $table->string('disponibilidad');
            $table->string('precio_renta');
            $table->string('descripcion');
            $table->foreignId('domicilio_id')->nullable()
                ->constrained()
                ->onDelete('cascade'); // Cascada
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
