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
            ['slug' => 'sstsena.admin.injury_types.index'],
            [
                'name' => 'ver listado de tipos de lesiones',
                'description' => 'vista principal de tipos de lesiones',
                'description_english' => 'View injury types list',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de creación
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.injury_types.create'],
            [
                'name' => 'mostrar formulario de tipos de lesiones',
                'description' => 'formulario para crear tipos de lesiones',
                'description_english' => 'Show create injury type form',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para almacenar tipos de lesiones
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.injury_types.store'],
            [
                'name' => 'almacenar nuevo tipo de lesión',
                'description' => 'guardar nuevo tipo de lesión',
                'description_english' => 'Store new injury type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de edición
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.injury_types.edit'],
            [
                'name' => 'mostrar formulario de edición de tipos de lesiones',
                'description' => 'editar tipo de lesión existente',
                'description_english' => 'Show edit form for injury type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para actualizar tipo de lesión
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.injury_types.update'],
            [
                'name' => 'actualizar tipo de lesión',
                'description' => 'guardar cambios en tipo de lesión',
                'description_english' => 'Update injury type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para actualizar tipo de lesión
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.injury_types.destroy'],
            [
                'name' => 'actualizar tipo de lesión',
                'description' => 'guardar cambios en tipo de lesión',
                'description_english' => 'Update injury type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;


        //--------------------------------------------------
        // Rutas para el index de tipos de riesgos
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.risk_types.index'], [ // Registro o actualización de permiso
            'name' => 'vista principal de tipos de riesgos',
            'description' => 'vista principal de tipos de riesgos',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Permiso para vista principal de tipos de riesgos
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.risk_types.index'],
            [
                'name' => 'ver listado de tipos de riesgos',
                'description' => 'vista principal de tipos de riesgos',
                'description_english' => 'View risk types list',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de creación
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.risk_types.create'],
            [
                'name' => 'mostrar formulario de tipos de riesgos',
                'description' => 'formulario para crear tipos de riesgos',
                'description_english' => 'Show create risk type form',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para almacenar tipos de riesgos
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.risk_types.store'],
            [
                'name' => 'almacenar nuevo tipo de riesgo',
                'description' => 'guardar nuevo tipo de riesgo',
                'description_english' => 'Store new risk type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de edición
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.risk_types.edit'],
            [
                'name' => 'mostrar formulario de edición de tipos de riesgos',
                'description' => 'editar tipo de riesgo existente',
                'description_english' => 'Show edit form for risk type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para actualizar tipo de riesgo
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.risk_types.update'],
            [
                'name' => 'actualizar tipo de riesgo',
                'description' => 'guardar cambios en tipo de riesgo',
                'description_english' => 'Update risk type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para eliminar tipo de riesgo
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.risk_types.destroy'],
            [
                'name' => 'eliminar tipo de riesgo',
                'description' => 'eliminar tipo de riesgo',
                'description_english' => 'Delete risk type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;


        //--------------------------------------------------

        // Rutas para el index de tipos de accidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.accident_types.index'], [ // Registro o actualización de permiso
            'name' => 'vista principal de tipos de accidentes',
            'description' => 'vista principal de tipos de accidentes',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Permiso para vista principal de tipos de accidentes
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.accident_types.index'],
            [
                'name' => 'ver listado de tipos de accidentes',
                'description' => 'vista principal de tipos de accidentes',
                'description_english' => 'View accident types list',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de creación
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.accident_types.create'],
            [
                'name' => 'mostrar formulario de tipos de accidentes',
                'description' => 'formulario para crear tipos de accidentes',
                'description_english' => 'Show create accident type form',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para almacenar tipos de accidentes
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.accident_types.store'],
            [
                'name' => 'almacenar nuevo tipo de accidente',
                'description' => 'guardar nuevo tipo de accidente',
                'description_english' => 'Store new accident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de edición
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.accident_types.edit'],
            [
                'name' => 'mostrar formulario de edición de tipos de accidentes',
                'description' => 'editar tipo de accidente existente',
                'description_english' => 'Show edit form for accident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para actualizar tipo de accidente
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.accident_types.update'],
            [
                'name' => 'actualizar tipo de accidente',
                'description' => 'guardar cambios en tipo de accidente',
                'description_english' => 'Update accident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para eliminar tipo de accidente
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.accident_types.destroy'],
            [
                'name' => 'eliminar tipo de accidente',
                'description' => 'eliminar tipo de accidente',
                'description_english' => 'Delete accident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        //--------------------------------------------------

        // Rutas para el index de tipos de personas
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.TypePerson.index'], [ // Registro o actualización de permiso
            'name' => 'vista principal de tipos de personas',
            'description' => 'vista principal de tipos de personas',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Permiso para vista principal de tipos de personas
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.TypePerson.index'],
            [
                'name' => 'ver listado de tipos de personas',
                'description' => 'vista principal de tipos de personas',
                'description_english' => 'View person types list',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de creación
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.TypePerson.create'],
            [
                'name' => 'mostrar formulario de tipos de personas',
                'description' => 'formulario para crear tipos de personas',
                'description_english' => 'Show create person type form',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para almacenar tipos de personas
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.TypePerson.store'],
            [
                'name' => 'almacenar nuevo tipo de persona',
                'description' => 'guardar nuevo tipo de persona',
                'description_english' => 'Store new person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de edición
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.TypePerson.edit'],
            [
                'name' => 'mostrar formulario de edición de tipos de personas',
                'description' => 'editar tipo de persona existente',
                'description_english' => 'Show edit form for person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para actualizar tipo de persona
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.TypePerson.update'],
            [
                'name' => 'actualizar tipo de persona',
                'description' => 'guardar cambios en tipo de persona',
                'description_english' => 'Update person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para eliminar tipo de persona
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.TypePerson.destroy'],
            [
                'name' => 'eliminar tipo de persona',
                'description' => 'eliminar tipo de persona',
                'description_english' => 'Delete person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Rutas para el index de tipos de incidentes
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.incident_types.index'], [ // Registro o actualización de permiso
            'name' => 'vista principal de tipos de incidentes',
            'description' => 'vista principal de tipos de incidentes',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Permiso para vista principal de tipos de incidentes
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.incident_types.index'],
            [
                'name' => 'ver listado de tipos de incidentes',
                'description' => 'vista principal de tipos de incidentes',
                'description_english' => 'View incident types list',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de creación
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.incident_types.create'],
            [
                'name' => 'mostrar formulario de tipos de incidentes',
                'description' => 'formulario para crear tipos de incidentes',
                'description_english' => 'Show create incident type form',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para almacenar tipos de incidentes
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.incident_types.store'],
            [
                'name' => 'almacenar nuevo tipo de incidente',
                'description' => 'guardar nuevo tipo de incidente',
                'description_english' => 'Store new incident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de edición
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.incident_types.edit'],
            [
                'name' => 'mostrar formulario de edición de tipos de incidentes',
                'description' => 'editar tipo de incidente existente',
                'description_english' => 'Show edit form for incident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para actualizar tipo de incidente
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.incident_types.update'],
            [
                'name' => 'actualizar tipo de incidente',
                'description' => 'guardar cambios en tipo de incidente',
                'description_english' => 'Update incident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para eliminar tipo de incidente
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.incident_types.destroy'],
            [
                'name' => 'eliminar tipo de incidente',
                'description' => 'eliminar tipo de incidente',
                'description_english' => 'Delete incident type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        //----------- Rutas para el Permiso del Index de Tipos de Emergencias -----------
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.emergency_type.index'],[
            'name' => 'vista principal de tipos de emergencias',
            'description' => 'vista principal de tipos de emergencias',
            'description_english' => 'Access to the Administrador Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // ------ Permiso para vista principal de tipos de emergencias
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.emergency_type.index'],
            [
                'name' => 'ver listado de tipos de emergencias',
                'description' => 'vista principal de tipos de emergencias',
                'description_english' => 'View emergency types list',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;
        // ------ Permiso para mostrar formulario de creación
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.emergency_type.create'],
            [
                'name' => 'mostrar formulario de tipos de emergencias',
                'description' => 'formulario para crear tipos de emergencias',
                'description_english' => 'Show create emergency type form',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // ------ Permiso para almacenar tipos de emergencias
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.emergency_type.store'],
            [
                'name' => 'almacenar nuevo tipo de emergencia',
                'description' => 'guardar nuevo tipo de emergencia',
                'description_english' => 'Store new emergency type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;
        // ------ Permiso para mostrar formulario de edición
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.emergency_type.edit'],
            [
                'name' => 'mostrar formulario de edición de tipos de emergencias',
                'description' => 'editar tipo de emergencia existente',
                'description_english' => 'Show edit form for emergency type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;
        // ------ Permiso para actualizar tipo de emergencia
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.emergency_type.update'],
            [
                'name' => 'actualizar tipo de emergencia',
                'description' => 'guardar cambios en tipo de emergencia',
                'description_english' => 'Update emergency type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // ------ Permiso para eliminar tipo de emergencia
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.admin.emergency_type.destroy'],
            [
                'name' => 'eliminar tipo de emergencia',
                'description' => 'eliminar tipo de emergencia',
                'description_english' => 'Delete emergency type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        //----------- Rutas para el Permiso del Index de Tipos de Actos Inseguros -----------
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.unsafe_act_types.index'],[
            'name' => 'vista principal de tipos de actos inseguros',
            'description' => 'vista principal de tipos actos inseguros',
            'description_english' => 'Access to the Administrador Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.unsafe_act_types.create'],[
            'name' => 'mostrar formulario de tipos de actos inseguros',
            'description' => 'formulario para crear tipos de actos inseguros',
            'description_english' => 'Show create unsafe act type form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.unsafe_act_types.store'],[
            'name' => 'almacenar tipos de actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.unsafe_act_types.edit'],[
            'name' => 'abrir formulario de editar de actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.unsafe_act_types.update'],[
            'name' => 'actualizar tipos de actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        $permission = Permission::updateOrCreate(['slug' => 'sstsena.admin.unsafe_act_types.destroy'],[
            'name' => 'eliminar tipos de actos inseguros',
            'description' => 'guardar nuevo de actos inseguros',
            'description_english' => 'Store new unsafe act type',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'sstsena.admin')->first(); // Rol Administrador

        // Asignación de PERMISOS para los ROLES de la aplicación SS (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
    }
}
