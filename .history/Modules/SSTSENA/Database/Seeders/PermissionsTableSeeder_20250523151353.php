<?php

namespace Modules\SSTSENA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear una lista de permisos para el rol 
        $permissions_admin = []; // Lista de permisos para el rol de administrador
         

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'sstsena')->first();


        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Acceso al Rol de Administrador',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        //--------------------------------------------------
        // Rutas para el index de tipos de lesiones
           $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.injury_types.index'], [ // Registro o actualización de permiso
            'name' => 'vista principal de tipos de lesiones',
            'description' => 'vista principal de tipos de lesiones',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

   // Permiso para vista principal de tipos de lesiones
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.injury_types.index'], [
        'name' => 'ver listado de tipos de lesiones',
        'description' => 'vista principal de tipos de lesiones',
        'description_english' => 'View injury types list',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para mostrar formulario de creación
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.injury_types.create'], [
        'name' => 'mostrar formulario de tipos de lesiones',
        'description' => 'formulario para crear tipos de lesiones',
        'description_english' => 'Show create injury type form',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para almacenar tipos de lesiones
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.injury_types.store'], [
        'name' => 'almacenar nuevo tipo de lesión',
        'description' => 'guardar nuevo tipo de lesión',
        'description_english' => 'Store new injury type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para mostrar formulario de edición
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.injury_types.edit'], [
        'name' => 'mostrar formulario de edición de tipos de lesiones',
        'description' => 'editar tipo de lesión existente',
        'description_english' => 'Show edit form for injury type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para actualizar tipo de lesión
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.injury_types.update'], [
        'name' => 'actualizar tipo de lesión',
        'description' => 'guardar cambios en tipo de lesión',
        'description_english' => 'Update injury type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para actualizar tipo de lesión
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.injury_types.destroy'], [
        'name' => 'actualizar tipo de lesión',
        'description' => 'guardar cambios en tipo de lesión',
        'description_english' => 'Update injury type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

 // Rutas para el index de tipos de riesgos
$permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.risk_types.index'], [ // Registro o actualización de permiso
    'name' => 'vista principal de tipos de riesgos',
    

      


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'sstsena.admin')->first(); // Rol Administrador
        
        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
    }
}
