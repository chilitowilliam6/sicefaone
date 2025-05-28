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

        // Rutas para el index de tipos de lesiones
           $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.injury_types.index'], [ // Registro o actualización de permiso
            'name' => 'vista principal de tipos de lesiones',
            'description' => 'vista principal de tipos de lesiones',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         // Route::get('/', [InjuryTypeController::class,"index"])->name('sstsena.admin.injury_types.index');
         //   Route::get('/create', [InjuryTypeController::class,"create"])->name('sstsena.admin.injury_types.create');
         //   Route::post('/store', [InjuryTypeController::class,"store"])->name('sstsena.admin.injury_types.store'); 
         //   Route::get('/{id}/edit', [InjuryTypeController::class,"edit"])->name('sstsena.admin.injury_types.edit');
         //   Route::put('/{id}/update', [InjuryTypeController::class,"update"])->name('sstsena.admin.injury_types.update');
      


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'sstsena.admin')->first(); // Rol Administrador
        
        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
    }
}
