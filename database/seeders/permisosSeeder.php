<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//Spatie
use Spatie\Permission\Models\Permission;

class permisosSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            //para roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'eliminar-rol',
            //para usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'elimnar-usuario',
            //para egresos
            'ver-egreso',
            'crear-egreso',
            'editar-egreso',
            'eliminar-egreso',
        ];
        foreach ($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
