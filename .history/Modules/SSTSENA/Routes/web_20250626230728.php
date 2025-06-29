<?php

namespace Modules\SSTSENA\Routes;

use Modules\SSTSENA\Http\Controllers\SSTSENAController;
use Modules\SSTSENA\Http\Controllers\InjuryTypeController;
use Modules\SSTSENA\Http\Controllers\RiskTypeController;
use Modules\SSTSENA\Http\Controllers\UnsafeActController;
use Modules\SSTSENA\Http\Controllers\AccidentTypeController;
use Modules\SSTSENA\Http\Controllers\AccidentController;
use Modules\SSTSENA\Http\Controllers\TypePersonController;
use Modules\SSTSENA\Http\Controllers\PeopleInvolvedController;
use Illuminate\Support\Facades\Route;
use Modules\SSTSENA\Http\Controllers\EmergencyTypeController;
use Modules\SSTSENA\Http\Controllers\IncidentTypeController;
use Modules\SSTSENA\Http\Controllers\IncidentController;
use Modules\SSTSENA\Http\Controllers\EmergencyController;
use Modules\SSTSENA\Http\Controllers\EventResponseController;
use Modules\SSTSENA\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Rutas del historial de eventos //
Route::get('responses/all', [EventResponseController::class, 'indexAllResponses'])->name('sstsena.responses.all');



   // Ruta para la vista general de eventos
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
   // Rutas para respuestas de Accidents
 Route::prefix('accidents/{accidentId}/responses')->name('sstsena.accidents.responses.')->group(function () {
        Route::get('/', [EventResponseController::class, 'indexAccidents'])->name('index');
        Route::get('/create', [EventResponseController::class, 'createAccidents'])->name('create');
        Route::post('/', [EventResponseController::class, 'storeAccidents'])->name('store');
        Route::get('/{id}/edit', [EventResponseController::class, 'editAccidents'])->name('edit');
        Route::put('/{id}', [EventResponseController::class, 'updateAccidents'])->name('update');
        Route::delete('/{id}', [EventResponseController::class, 'destroyAccidents'])->name('destroy');
    });

   // Rutas para respuestas de Incidents
    Route::prefix('incidents/{incidentId}/responses')->name('sstsena.incidents.responses.')->group(function () {
        Route::get('/', [EventResponseController::class, 'indexIncidents'])->name('index');
        Route::get('/create', [EventResponseController::class, 'createIncidents'])->name('create');
        Route::post('/', [EventResponseController::class, 'storeIncidents'])->name('store');
        Route::get('/{id}/edit', [EventResponseController::class, 'editIncidents'])->name('edit');
        Route::put('/{id}', [EventResponseController::class, 'updateIncidents'])->name('update');
        Route::delete('/{id}', [EventResponseController::class, 'destroyIncidents'])->name('destroy');
    });

    // Rutas para respuestas de Emergencies
    Route::prefix('emergencies/{emergencyId}/responses')->name('sstsena.emergencies.responses.')->group(function () {
        Route::get('/', [EventResponseController::class, 'indexEmergencies'])->name('index');
        Route::get('/create', [EventResponseController::class, 'createEmergencies'])->name('create');
        Route::post('/', [EventResponseController::class, 'storeEmergencies'])->name('store');
        Route::get('/{id}/edit', [EventResponseController::class, 'editEmergencies'])->name('edit');
        Route::put('/{id}', [EventResponseController::class, 'updateEmergencies'])->name('update');
        Route::delete('/{id}', [EventResponseController::class, 'destroyEmergencies'])->name('destroy');
    });

    // Rutas para respuestas de Unsafe Acts
    Route::prefix('unsafe_acts/{unsafeActId}/responses')->name('sstsena.unsafe_acts.responses.')->group(function () {
        Route::get('/', [EventResponseController::class, 'indexUnsafeActs'])->name('index');
        Route::get('/create', [EventResponseController::class, 'createUnsafeActs'])->name('create');
        Route::post('/', [EventResponseController::class, 'storeUnsafeActs'])->name('store');
        Route::get('/{id}/edit', [EventResponseController::class, 'editUnsafeActs'])->name('edit');
        Route::put('/{id}', [EventResponseController::class, 'updateUnsafeActs'])->name('update');
        Route::delete('/{id}', [EventResponseController::class, 'destroyUnsafeActs'])->name('destroy');
    });


Route::get('/SSTSENA/welcome', [SSTSENAController::class, "welcome"])->name('cefa.sstsena.index');

Route::middleware(['lang'])->group(function () { // Middleware que permite la internacionalización

  

  

 
        // Vista de bienvenida para el administrador
        Route::get('/welcome/admin', [SSTSENAController::class, "admin"])->name('sstsena.admin.welcome');

        //  Vista de bienvenida para el funcionario
        Route::get('/welcome/funcionario', [SSTSENAController::class, "funcionario"])->name('sstsena.funcionario.welcome');

        // Tipos de lesión
        Route::prefix('injury_types')->group(function () {
            Route::get('/', [InjuryTypeController::class, "index"])->name('sstsena.admin.injury_types.index');
            Route::get('/create', [InjuryTypeController::class, "create"])->name('sstsena.admin.injury_types.create');
            Route::post('/store', [InjuryTypeController::class, "store"])->name('sstsena.admin.injury_types.store');
            Route::get('/{id}/edit', [InjuryTypeController::class, "edit"])->name('sstsena.admin.injury_types.edit');
            Route::put('/{id}/update', [InjuryTypeController::class, "update"])->name('sstsena.admin.injury_types.update');
            Route::delete('/{id}/destroy', [InjuryTypeController::class, "destroy"])->name('sstsena.admin.injury_types.destroy');
        });

        // Tipos de riesgo
        Route::prefix('risk_types')->group(function () {
            Route::get('/', [RiskTypeController::class, "index"])->name('sstsena.admin.risk_types.index');
            Route::get('/create', [RiskTypeController::class, "create"])->name('sstsena.admin.risk_types.create');
            Route::post('/store', [RiskTypeController::class, "store"])->name('sstsena.admin.risk_types.store');
            Route::get('/{id}/edit', [RiskTypeController::class, "edit"])->name('sstsena.admin.risk_types.edit');
            Route::put('/{id}/update', [RiskTypeController::class, "update"])->name('sstsena.admin.risk_types.update');
            Route::delete('/{id}/destroy', [RiskTypeController::class, "destroy"])->name('sstsena.admin.risk_types.destroy');
        });

        // Tipos de accidente
        Route::prefix('accident_types')->group(function () {
            Route::get('/', [AccidentTypeController::class, "index"])->name('sstsena.admin.accident_types.index');
            Route::get('/create', [AccidentTypeController::class, "create"])->name('sstsena.admin.accident_types.create');
            Route::post('/store', [AccidentTypeController::class, "store"])->name('sstsena.admin.accident_types.store');
            Route::get('/{id}/edit', [AccidentTypeController::class, "edit"])->name('sstsena.admin.accident_types.edit');
            Route::put('/{id}/update', [AccidentTypeController::class, "update"])->name('sstsena.admin.accident_types.update');
            Route::delete('/{id}/destroy', [AccidentTypeController::class, "destroy"])->name('sstsena.admin.accident_types.destroy');
        });

        // Accidentes
        Route::prefix('accidents')->group(function () {
            Route::get('/', [AccidentController::class, "index"])->name('sstsena.funcionario.accidents.index');
            Route::get('/create', [AccidentController::class, "create"])->name('sstsena.funcionario.accidents.create');
            Route::post('/store', [AccidentController::class, "store"])->name('sstsena.funcionario.accidents.store');
            Route::get('/{id}/edit', [AccidentController::class, "edit"])->name('sstsena.funcionario.accidents.edit');
            Route::put('/{id}/update', [AccidentController::class, "update"])->name('sstsena.funcionario.accidents.update');
            Route::delete('/{id}/destroy', [AccidentController::class, "destroy"])->name('sstsena.funcionario.accidents.destroy');
        });

        // Tipo de persona implicada
        Route::prefix('TypePerson')->group(function () {
            Route::get('/', [TypePersonController::class, "index"])->name('sstsena.admin.TypePerson.index');
            Route::get('/create', [TypePersonController::class, "create"])->name('sstsena.admin.TypePerson.create');
            Route::post('/store', [TypePersonController::class, "store"])->name('sstsena.admin.TypePerson.store');
            Route::get('/{id}/edit', [TypePersonController::class, "edit"])->name('sstsena.admin.TypePerson.edit');
            Route::put('/{id}/update', [TypePersonController::class, "update"])->name('sstsena.admin.TypePerson.update');
            Route::delete('/{id}/destroy', [TypePersonController::class, "destroy"])->name('sstsena.admin.TypePerson.destroy');
        });

        // Personas implicadas en accidentes
        Route::prefix('people_involved')->group(function () {
            Route::get('/', [PeopleInvolvedController::class, "index"])->name('sstsena.funcionario.people_involved.index');
            Route::get('/create', [PeopleInvolvedController::class, "create"])->name('sstsena.funcionario.people_involved.create');
            Route::post('/store', [PeopleInvolvedController::class, "store"])->name('sstsena.funcionario.people_involved.store');
            Route::get('/{id}/edit', [PeopleInvolvedController::class, "edit"])->name('sstsena.funcionario.people_involved.edit');
            Route::put('/{id}/update', [PeopleInvolvedController::class, "update"])->name('sstsena.funcionario.people_involved.update');
            Route::delete('/{id}/destroy', [PeopleInvolvedController::class, "destroy"])->name('sstsena.funcionario.people_involved.destroy');


           
            Route::get('/admin', [PeopleInvolvedController::class, "index"])->name('sstsena.admin.people_involved.index');
            Route::get('/admin/create', [PeopleInvolvedController::class, "create"])->name('sstsena.admin.people_involved.create');
            Route::post('/admin/store', [PeopleInvolvedController::class, "store"])->name('sstsena.admin.people_involved.store');
            Route::get('/admin/{id}/edit', [PeopleInvolvedController::class, "edit"])->name('sstsena.admin.people_involved.edit');
            Route::put('/admin/{id}/update', [PeopleInvolvedController::class, "update"])->name('sstsena.admin.people_involved.update');
            Route::delete('/admin/{id}/destroy', [PeopleInvolvedController::class, "destroy"])->name('sstsena.admin.people_involved.destroy');
         
        });

        // Tipos de incidentes
        Route::prefix('incident_types')->group(function () {
            Route::get('/', [IncidentTypeController::class, "index"])->name('sstsena.admin.incident_types.index');
            Route::get('/create', [IncidentTypeController::class, "create"])->name('sstsena.admin.incident_types.create');
            Route::post('/store', [IncidentTypeController::class, "store"])->name('sstsena.admin.incident_types.store');
            Route::get('/{id}/edit', [IncidentTypeController::class, "edit"])->name('sstsena.admin.incident_types.edit');
            Route::put('/{id}/update', [IncidentTypeController::class, "update"])->name('sstsena.admin.incident_types.update');
            Route::delete('/{id}/destroy', [IncidentTypeController::class, "destroy"])->name('sstsena.admin.incident_types.destroy');
        });

        // Incidentes
        Route::prefix('incidents')->group(function () {
            Route::get('/', [IncidentController::class, "index"])->name('sstsena.funcionario.incidents.index');
            Route::get('/create', [IncidentController::class, "create"])->name('sstsena.funcionario.incidents.create');
            Route::post('/store', [IncidentController::class, "store"])->name('sstsena.funcionario.incidents.store');
            Route::get('/{id}/edit', [IncidentController::class, "edit"])->name('sstsena.funcionario.incidents.edit');
            Route::put('/{id}/update', [IncidentController::class, "update"])->name('sstsena.funcionario.incidents.update');
            Route::delete('/{id}/destroy', [IncidentController::class, "destroy"])->name('sstsena.funcionario.incidents.destroy');
        });

        // Tipos de emergencia
        Route::prefix('emergency_types')->group(function () {
            Route::get('/', [EmergencyTypeController::class, "index"])->name('sstsena.admin.emergency_type.index');
            Route::get('/create', [EmergencyTypeController::class, "create"])->name('sstsena.admin.emergency_type.create');
            Route::post('/store', [EmergencyTypeController::class, "store"])->name('sstsena.admin.emergency_type.store');
            Route::get('/{id}/edit', [EmergencyTypeController::class, "edit"])->name('sstsena.admin.emergency_type.edit');
            Route::put('/{id}/update', [EmergencyTypeController::class, "update"])->name('sstsena.admin.emergency_type.update');
            Route::delete('/{id}/destroy', [EmergencyTypeController::class, "destroy"])->name('sstsena.admin.emergency_type.destroy');
        });

        // Emergencias
        Route::prefix('emergencies')->group(function () {
            Route::get('/', [EmergencyController::class, "index"])->name('sstsena.funcionario.emergencies.index');
            Route::get('/create', [EmergencyController::class, "create"])->name('sstsena.funcionario.emergencies.create');
            Route::post('/store', [EmergencyController::class, "store"])->name('sstsena.funcionario.emergencies.store');
            Route::get('/{id}/edit', [EmergencyController::class, "edit"])->name('sstsena.funcionario.emergencies.edit');
            Route::put('/{id}/update', [EmergencyController::class, "update"])->name('sstsena.funcionario.emergencies.update');
            Route::delete('/{id}/destroy', [EmergencyController::class, "destroy"])->name('sstsena.funcionario.emergencies.destroy');
        });

        // Tipos de actos inseguros
        Route::prefix('unsafe_act_types')->group(function () {
            Route::get('/', [UnsafeActController::class, "index_type"])->name('sstsena.admin.unsafe_act_types.index');
            Route::get('/create', [UnsafeActController::class, "create_type"])->name('sstsena.admin.unsafe_act_types.create');
            Route::post('/store', [UnsafeActController::class, "store_type"])->name('sstsena.admin.unsafe_act_types.store');
            Route::get('/{id}/edit', [UnsafeActController::class, "edit_type"])->name('sstsena.admin.unsafe_act_types.edit');
            Route::put('/{id}/update', [UnsafeActController::class, "update_type"])->name('sstsena.admin.unsafe_act_types.update');
            Route::delete('/{id}/destroy', [UnsafeActController::class, "destroy_type"])->name('sstsena.admin.unsafe_act_types.destroy');
        });

        // Actos inseguros
        Route::prefix('unsafe_acts')->group(function () {
            Route::get('/', [UnsafeActController::class, "index"])->name('sstsena.funcionario.unsafe_acts.index');
            Route::get('/create', [UnsafeActController::class, "create"])->name('sstsena.funcionario.unsafe_acts.create');
            Route::post('/store', [UnsafeActController::class, "store"])->name('sstsena.funcionario.unsafe_acts.store');
            Route::get('/{id}/edit', [UnsafeActController::class, "edit"])->name('sstsena.funcionario.unsafe_acts.edit');
            Route::put('/{id}/update', [UnsafeActController::class, "update"])->name('sstsena.funcionario.unsafe_acts.update');
            Route::delete('/{id}/destroy', [UnsafeActController::class, "destroy"])->name('sstsena.funcionario.unsafe_acts.destroy');
        });
        
    });

