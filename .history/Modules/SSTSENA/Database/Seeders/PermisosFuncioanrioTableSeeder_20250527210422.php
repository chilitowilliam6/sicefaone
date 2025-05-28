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
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        //-------------------------------------------------
        // Rutas para el index de Accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.accidents.index'], [ // Registro o actualización de permiso
            'name' => 'Acceso al listado de Accidentes',
            'description' => 'Acceso al listado de Accidentes',
            'description_english' => 'Access to the list of Accidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para vista principal de Accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.accidents.index'], [ // Registro o actualización de permiso
            'name' => 'ver lista de Accidentes',
            'description' => 'ver lista de Accidentes',
            'description_english' => 'view list of Accidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para crear Accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.accidents.create'], [ // Registro o actualización de permiso
            'name' => 'Crear Accidentes',
            'description' => 'Crear Accidentes',
            'description_english' => 'Create Accidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        //permiso para almacenar Accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.accidents.store'], [ // Registro o actualización de permiso
            'name' => 'Almacenar Accidentes',
            'description' => 'Almacenar Accidentes',
            'description_english' => 'Store Accidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para editar Accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.accidents.edit'], [ // Registro o actualización de permiso
            'name' => 'Editar Accidentes', 
            'description' => 'Editar Accidentes',
            'description_english' => 'Edit Accidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para actualizar Accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.accidents.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar Accidentes',
            'description' => 'Actualizar Accidentes', 
            'description_english' => 'Update Accidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para eliminar Accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.accidents.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Accidentes',
            'description' => 'Eliminar Accidentes',
            'description_english' => 'Delete Accidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        //-------------------------------------------------

        // Rutas para el index de Personas Involucradas
   //        Route::get('/', [PeopleInvolvedController::class,"index"])->name('sstsena.funcionario.people_involved.index');
   //                 Route::get('/create', [PeopleInvolvedController::class,"create"])->name('sstsena.funcionario.people_involved.create');
   //                 Route::post('/store', [PeopleInvolvedController::class,"store"])->name('sstsena.funcionario.people_involved.store');
   //                 Route::get('/{id}/edit', [PeopleInvolvedController::class,"edit"])->name('sstsena.funcionario.people_involved.edit');
   //                 Route::put('/{id}/update', [PeopleInvolvedController::class,"update"])->name('sstsena.funcionario.people_involved.update');
   //                 Route::delete('/{id}/destroy', [PeopleInvolvedController::class,"destroy"])->name('sstsena.funcionario.people_involved.destroy');      
        
        // Permiso para ver lista de Personas Involucradas
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.people_involved.index'], [ // Registro o actualización de permiso
            'name' => 'ver lista de Personas Involucradas',
            'description' => 'ver lista de Personas Involucradas',
            'description_english' => 'view list of People Involved',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para crear Personas Involucradas
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.people_involved.create'], [ // Registro o actualización de permiso
            'name' => 'Crear Personas Involucradas',
            'description' => 'Crear Personas Involucradas',
            'description_english' => 'Create People Involved',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para almacenar Personas Involucradas
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.people_involved.store'], [ // Registro o actualización de permiso
            'name' => 'Almacenar Personas Involucradas',
            'description' => 'Almacenar Personas Involucradas',
            'description_english' => 'Store People Involved',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para editar Personas Involucradas
        
        


        // Consulta de ROLES
         $rol_funcionario = Role::where('slug', 'sstsena.funcionario')->first(); // Rol Administrador


        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
         $rol_funcionario->permissions()->syncWithoutDetaching($permissions_funcionario);
    }
}
