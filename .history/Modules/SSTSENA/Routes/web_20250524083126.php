<?php
use Modules\SSTSENA\Http\Controllers\SSTSENAController;
use Modules\SSTSENA\Http\Controllers\InjuryTypeController;
use Modules\SSTSENA\Http\Controllers\RiskTypeController;
use Modules\SSTSENA\Http\Controllers\AccidentTypesController;
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
Route::middleware(['lang'])->group(function () { //Middleware que permite la internacionalizacion

    Route::prefix('SSTSENA')->group(function() {
        Route::get('/welcome/admin', [SSTSENAController::class,"admin"])->name('sstsena.admin.welcome');

        Route::prefix('injury_types')->group(function() {
            Route::get('/', [InjuryTypeController::class,"index"])->name('sstsena.admin.injury_types.index');
            Route::get('/create', [InjuryTypeController::class,"create"])->name('sstsena.admin.injury_types.create');
            Route::post('/store', [InjuryTypeController::class,"store"])->name('sstsena.admin.injury_types.store'); 
            Route::get('/{id}/edit', [InjuryTypeController::class,"edit"])->name('sstsena.admin.injury_types.edit');
            Route::put('/{id}/update', [InjuryTypeController::class,"update"])->name('sstsena.admin.injury_types.update');
            Route::delete('/{id}/destroy', [InjuryTypeController::class,"destroy"])->name('sstsena.admin.injury_types.destroy');

          Route::prefix('risk_types')->group(function(){
            Route::get('/', [RiskTypeController::class,"index"])->name('sstsena.admin.risk_types.index');
            Route::get('/create', [RiskTypeController::class,"create"])->name('sstsena.admin.risk_types.create');
            Route::post('/store', [RiskTypeController::class,"store"])->name('sstsena.admin.risk_types.store'); 
            Route::get('/{id}/edit', [RiskTypeController::class,"edit"])->name('sstsena.admin.risk_types.edit');
            Route::put('/{id}/update', [RiskTypeController::class,"update"])->name('sstsena.admin.risk_types.update');
            Route::delete('/{id}/destroy', [RiskTypeController::class,"destroy"])->name('sstsena.admin.risk_types.destroy');

          Route::prefix('accident_types')->group(function() {
            Route::get('/', [AccidentTypesController::class,"index"])->name('sstsena.admin.accident_types.index');
            Route::get('/create', [AccidentTypesController::class,"create"])->name('sstsena.admin.accident_types.create');
            Route::post('/store', [AccidentTypesController::class,"store"])->name('sstsena.admin.accident_types.store'); 
            Route::get('/{id}/edit', [AccidentTypesController::class,"edit"])->name('sstsena.admin.accident_types.edit');
            Route::put('/{id}/update', [AccidentTypesController::class,"update"])->name('sstsena.admin.accident_types.update');
            Route::delete('/{id}/destroy', [AccidentTypesController::class,"destroy"])->name('sstsena.admin.accident_types.destroy');
           });
        });
      });
    });
  });