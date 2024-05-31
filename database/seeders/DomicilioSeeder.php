<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domicilio; // Asegúrate de tener este modelo creado
use Faker\Factory as Faker;

class DomicilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { // Genera 10 registros de prueba
            Domicilio::create([
                'calle' => $faker->streetName, // Genera una calle falsa
                'numero' => $faker->buildingNumber, // Genera un número de edificio falso
                'colonia' => $faker->citySuffix, // Genera una colonia falsa
            ]);
        }
    }
}
