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
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.people_involved.edit'], [ // Registro o actualización de permiso
            'name' => 'Editar Personas Involucradas',
            'description' => 'Editar Personas Involucradas',
            'description_english' => 'Edit People Involved',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para actualizar Personas Involucradas
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.people_involved.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar Personas Involucradas',
            'description' => 'Actualizar Personas Involucradas',
            'description_english' => 'Update People Involved',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para eliminar Personas Involucradas
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.people_involved.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Personas Involucradas',
            'description' => 'Eliminar Personas Involucradas',
            'description_english' => 'Delete People Involved',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol
        $per

        //-------------------------------------------------

        // Permiso para ver lista de Incidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.incidents.index'], [ // Registro o actualización de permiso
            'name' => 'ver lista de Incidentes',
            'description' => 'ver lista de Incidentes',
            'description_english' => 'view list of Incidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para crear Incidentes

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.incidents.create'], [ // Registro o actualización de permiso
            'name' => 'Crear Incidentes',
            'description' => 'Crear Incidentes',
            'description_english' => 'Create Incidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para almacenar Incidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.incidents.store'], [ // Registro o actualización de permiso
            'name' => 'Almacenar Incidentes',
            'description' => 'Almacenar Incidentes',
            'description_english' => 'Store Incidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para editar Incidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.incidents.edit'], [ // Registro o actualización de permiso
            'name' => 'Editar Incidentes',
            'description' => 'Editar Incidentes',
            'description_english' => 'Edit Incidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para actualizar Incidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.incidents.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar Incidentes',
            'description' => 'Actualizar Incidentes',
            'description_english' => 'Update Incidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para eliminar Incidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.incidents.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Incidentes',
            'description' => 'Eliminar Incidentes',
            'description_english' => 'Delete Incidents',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        //-------------------------------------------------

        // Permiso para ver lista de Emergencias
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.emergencies.index'], [ // Registro o actualización de permiso
            'name' => 'ver lista de Emergencias',
            'description' => 'ver lista de Emergencias',
            'description_english' => 'view list of Emergencies',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[]=$permission->id; // Almacenar permiso para rol
        // Permiso para crear Emergencias
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.emergencies.create'], [ // Registro o actualización de permiso
            'name' => 'Crear Emergencias',
            'description' => 'Crear Emergencias',
            'description_english' => 'Create Emergencies',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[]=$permission->id; // Almacenar permiso para rol

        // Permiso para almacenar Emergencias
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.emergencies.store'], [ // Registro o actualización de permiso
            'name' => 'Almacenar Emergencias',
            'description' => 'Almacenar Emergencias',
            'description_english' => 'Store Emergencies',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[]= $permission->id;

        // Permiso para editar Emergencias
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.emergencies.edit'], [
            'name' => 'Editar Emergencias',
            'description' => 'Editar Emergencias',
            'description_english' => 'Edit Emergencies',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate([ 'slug' => 'sstsena.funcionario.emergencies.update'], [
            'name' => 'Actualizar Emergencias',
            'description' => 'Actualizar Emergencias',
            'description_english' => 'Update Emergencies',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Permiso para eliminar Emergencias
        $permission = Permission::updateOrCreate([ 'slug' => 'sstsena.funcionario.emergencies.destroy'],[
            'name' => 'Eliminar Emergencias',
            'description' => 'Eliminar Emergencias',
            'description_english' => 'Delete Emergencies',
            'app_id' => $app->id
        ]);

        $permissions_funcionario[] = $permission->id;

        //----------- Rutas para el Permiso del Index Actos Inseguros -----------
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.unsafe_acts.index'],[
            'name' => 'vista principal de actos inseguros',
            'description' => 'vista principal de tipos actos inseguros',
            'description_english' => 'Access to the Administrador Role',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.unsafe_acts.create'],[
            'name' => 'mostrar formulario de actos inseguros',
            'description' => 'formulario para crear actos inseguros',
            'description_english' => 'Show create unsafe act type form',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.unsafe_acts.store'],[
            'name' => 'almacenar actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

         $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.unsafe_acts.edit'],[
            'name' => 'abrir formulario de editar de actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.unsafe_acts.update'],[
            'name' => 'actualizar actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.unsafe_acts.destroy'],[
            'name' => 'eliminar actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_funcionario[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_funcionario = Role::where('slug', 'sstsena.funcionario')->first(); // Rol Administrador


        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_funcionario->permissions()->syncWithoutDetaching($permissions_funcionario);
    }
}
