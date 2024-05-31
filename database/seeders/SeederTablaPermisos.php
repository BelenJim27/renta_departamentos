<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            
            //Operacions sobre tabla usuario
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            //Operacions sobre tabla terreno
            'ver-departamento',
            'crear-departamento',
            'editar-departamento',
            'borrar-departamento',

            //Operacions sobre tabla pago
            'ver-renta',
            'crear-renta',
            'editar-renta',
            'borrar-renta',

            
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]); }
        }
}