<?php
use Modules\SSTSENA\Http\Controllers\SSTSENAController;
use Modules\SSTSENA\Http\Controllers\InjuryTypeController;
use Modules\SSTSENA\Http\Controllers\RiskTypeController;
use Modules\SSTSENA\Http\Controllers\AccidentTypeController;
use Modules\SSTSENA\Http\Controllers\AccidentController;
use Illuminate\Support\Facades\Route;
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
Route::get('/SSTSENA/welcome', [SSTSENAController::class,"welcome"])->name('cefa.sstsena.index');

Route::middleware(['lang'])->group(function () { // Middleware que permite la internacionalización

    Route::prefix('SSTSENA')->group(function() {

        // Vista de bienvenida para el administrador
        Route::get('/welcome/admin', [SSTSENAController::class,"admin"])->name('sstsena.admin.welcome');

        //  Vista de bienvenida para el funcionario
        Route::get('/welcome/funcionario', [SSTSENAController::class,"funcionario"])->name('sstsena.funcionario.welcome');

        // Subgrupo de tipos de lesión
        Route::prefix('injury_types')->group(function() {
            Route::get('/', [InjuryTypeController::class,"index"])->name('sstsena.admin.injury_types.index');
            Route::get('/create', [InjuryTypeController::class,"create"])->name('sstsena.admin.injury_types.create');
            Route::post('/store', [InjuryTypeController::class,"store"])->name('sstsena.admin.injury_types.store'); 
            Route::get('/{id}/edit', [InjuryTypeController::class,"edit"])->name('sstsena.admin.injury_types.edit');
            Route::put('/{id}/update', [InjuryTypeController::class,"update"])->name('sstsena.admin.injury_types.update');
            Route::delete('/{id}/destroy', [InjuryTypeController::class,"destroy"])->name('sstsena.admin.injury_types.destroy');

            // Subgrupo de tipos de riesgo
            Route::prefix('risk_types')->group(function(){
                Route::get('/', [RiskTypeController::class,"index"])->name('sstsena.admin.risk_types.index');
                Route::get('/create', [RiskTypeController::class,"create"])->name('sstsena.admin.risk_types.create');
                Route::post('/store', [RiskTypeController::class,"store"])->name('sstsena.admin.risk_types.store'); 
                Route::get('/{id}/edit', [RiskTypeController::class,"edit"])->name('sstsena.admin.risk_types.edit');
                Route::put('/{id}/update', [RiskTypeController::class,"update"])->name('sstsena.admin.risk_types.update');
                Route::delete('/{id}/destroy', [RiskTypeController::class,"destroy"])->name('sstsena.admin.risk_types.destroy');

                // Subgrupo de tipos de accidente
                Route::prefix('accident_types')->group(function() {
                    Route::get('/', [AccidentTypeController::class,"index"])->name('sstsena.admin.accident_types.index');
                    Route::get('/create', [AccidentTypeController::class,"create"])->name('sstsena.admin.accident_types.create');
                    Route::post('/store', [AccidentTypeController::class,"store"])->name('sstsena.admin.accident_types.store'); 
                    Route::get('/{id}/edit', [AccidentTypeController::class,"edit"])->name('sstsena.admin.accident_types.edit');
                    Route::put('/{id}/update', [AccidentTypeController::class,"update"])->name('sstsena.admin.accident_types.update');
                    Route::delete('/{id}/destroy', [AccidentTypeController::class,"destroy"])->name('sstsena.admin.accident_types.destroy');

                //subgrupo de accidentes
                Route::prefix('accidents')->group(function() {
                    Route::get('/', [AccidentController::class,"index"])->name('sstsena.funcionario.accidents.index');
                    Route::get('/create', [AccidentController::class,"create"])->name('sstsena.funcionario.accidents.create');
                    Route::post('/store', [AccidentController::class,"store"])->name('sstsena.funcionario.accidents.store'); 
                    Route::get('/{id}/edit', [AccidentController::class,"edit"])->name('sstsena.funcionario.accidents.edit');
                    Route::put('/{id}/update', [AccidentController::class,"update"])->name('sstsena.funcionario.accidents.update');
                    Route::delete('/{id}/destroy', [AccidentController::class,"destroy"])->name('sstsena.funcionario.accidents.destroy');    
                    
                });
            });
        });
    });

});
});
