<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;
use Faker\Factory as Faker;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $descripcion = $faker->paragraph; // Genera una descripción falsa
            $descripcion_truncada = substr($descripcion, 0, 100); // Trunca la descripción a 100 caracteres

            Departamento::create([
                'imagen' => $faker->imageUrl($width = 640, $height = 480),
                'disponibilidad' => $faker->randomElement(['disponible', 'no disponible']),
                'precio_renta' => $faker->randomFloat(2, 500, 5000),
                'descripcion' => $descripcion_truncada, // Utiliza la descripción truncada
                'domicilio_id' => $faker->optional()->randomDigitNotNull,
            ]);
        }
    }
}
