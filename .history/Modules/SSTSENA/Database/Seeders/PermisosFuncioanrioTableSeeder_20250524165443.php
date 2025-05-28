<?php

namespace Modules\SSTSENA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermisosFuncioanrioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Crear una lista de permisos para el rol 
       
          $permissions_funcionario = []; // Lista de permisos para el rol de funcionario


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'sstsena')->first();

        // Rutas funcionario
         $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de funcionario',
            'description' => 'Acceso al Rol de funcionario',
            'description_english' => 'Access to the funcionario Role',
            'app_id' => $app->id
        ]);

        //-------------------------------------------------

        
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol


        // Consulta de ROLES
         $rol_funcionario = Role::where('slug', 'sstsena.funcionario')->first(); // Rol Administrador


        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
         $rol_funcionario->permissions()->syncWithoutDetaching($permissions_funcionario);
    }
}
