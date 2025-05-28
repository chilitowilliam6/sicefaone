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
    ['slug' => 'sstsena.admin.risk_types.index'], [
        'name' => 'ver listado de tipos de riesgos',
        'description' => 'vista principal de tipos de riesgos',
        'description_english' => 'View risk types list',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para mostrar formulario de creación
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.risk_types.create'], [
        'name' => 'mostrar formulario de tipos de riesgos',
        'description' => 'formulario para crear tipos de riesgos',
        'description_english' => 'Show create risk type form',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para almacenar tipos de riesgos
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.risk_types.store'], [
        'name' => 'almacenar nuevo tipo de riesgo',
        'description' => 'guardar nuevo tipo de riesgo',
        'description_english' => 'Store new risk type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para mostrar formulario de edición
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.risk_types.edit'], [
        'name' => 'mostrar formulario de edición de tipos de riesgos',
        'description' => 'editar tipo de riesgo existente',
        'description_english' => 'Show edit form for risk type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para actualizar tipo de riesgo
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.risk_types.update'], [
        'name' => 'actualizar tipo de riesgo',
        'description' => 'guardar cambios en tipo de riesgo',
        'description_english' => 'Update risk type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para eliminar tipo de riesgo
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.risk_types.destroy'], [
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
    ['slug' => 'sstsena.admin.accident_types.index'], [
        'name' => 'ver listado de tipos de accidentes',
        'description' => 'vista principal de tipos de accidentes',
        'description_english' => 'View accident types list',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para mostrar formulario de creación
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.accident_types.create'], [
        'name' => 'mostrar formulario de tipos de accidentes',
        'description' => 'formulario para crear tipos de accidentes',
        'description_english' => 'Show create accident type form',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para almacenar tipos de accidentes
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.accident_types.store'], [
        'name' => 'almacenar nuevo tipo de accidente',
        'description' => 'guardar nuevo tipo de accidente',
        'description_english' => 'Store new accident type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para mostrar formulario de edición
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.accident_types.edit'], [
        'name' => 'mostrar formulario de edición de tipos de accidentes',
        'description' => 'editar tipo de accidente existente',
        'description_english' => 'Show edit form for accident type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para actualizar tipo de accidente
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.accident_types.update'], [
        'name' => 'actualizar tipo de accidente',
        'description' => 'guardar cambios en tipo de accidente',
        'description_english' => 'Update accident type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

// Permiso para eliminar tipo de accidente
$permission = Permission::updateOrCreate(
    ['slug' => 'sstsena.admin.accident_types.destroy'], [
        'name' => 'eliminar tipo de accidente',
        'description' => 'eliminar tipo de accidente',
        'description_english' => 'Delete accident type',
        'app_id' => $app->id
    ]
);
$permissions_admin[] = $permission->id;

//--------------------------------------------------

//Route::get('/', [TypePersonController::class,"index"])->name('sstsena.funcionario.TypePerson.index');
//                    Route::get('/create', [TypePersonController::class,"create"])->name('sstsena.funcionario.TypePerson.create');
//                    Route::post('/store', [TypePersonController::class,"store"])->name('sstsena.funcionario.TypePerson.store');
//                    Route::get('/{id}/edit', [TypePersonController::class,"edit"])->name('sstsena.funcionario.TypePerson.edit');
//                    Route::put('/{id}/update', [TypePersonController::class,"update"])->name('sstsena.funcionario.TypePerson.update');
//                    Route::delete('/{id}/destroy', [TypePersonController::class,"destroy"])->name('sstsena.funcionario.TypePerson.destroy');

        // Rutas para el index de tipos de personas
        $permission = Permission::updateOrCreate(['slug' => 'sstsena.funcionario.TypePerson.index'], [ // Registro o actualización de permiso
            'name' => 'vista principal de tipos de personas',
            'description' => 'vista principal de tipos de personas',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        
        // Permiso para vista principal de tipos de personas
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.funcionario.TypePerson.index'], [
                'name' => 'ver listado de tipos de personas',
                'description' => 'vista principal de tipos de personas',
                'description_english' => 'View person types list',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de creación
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.funcionario.TypePerson.create'], [
                'name' => 'mostrar formulario de tipos de personas',
                'description' => 'formulario para crear tipos de personas',
                'description_english' => 'Show create person type form',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;
        
        // Permiso para almacenar tipos de personas
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.funcionario.TypePerson.store'], [
                'name' => 'almacenar nuevo tipo de persona',
                'description' => 'guardar nuevo tipo de persona',
                'description_english' => 'Store new person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para mostrar formulario de edición
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.funcionario.TypePerson.edit'], [
                'name' => 'mostrar formulario de edición de tipos de personas',
                'description' => 'editar tipo de persona existente',
                'description_english' => 'Show edit form for person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para actualizar tipo de persona
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.funcionario.TypePerson.update'], [
                'name' => 'actualizar tipo de persona',
                'description' => 'guardar cambios en tipo de persona',
                'description_english' => 'Update person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

        // Permiso para eliminar tipo de persona
        $permission = Permission::updateOrCreate(
            ['slug' => 'sstsena.funcionario.TypePerson.destroy'], [
                'name' => 'eliminar tipo de persona',
                'description' => 'eliminar tipo de persona',
                'description_english' => 'Delete person type',
                'app_id' => $app->id
            ]
        );
        $permissions_admin[] = $permission->id;

      
        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'sstsena.admin')->first(); // Rol Administrador
        
        // Asignación de PERMISOS para los ROLES de la aplicación AGROSOFT (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
    }
}
