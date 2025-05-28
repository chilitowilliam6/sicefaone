<?php

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
 Route::get('/SSTSENA/', 'SSTSENAController@index')->name('cefa.sstsena.index');
Route::middleware(['lang'])->group(function () { //Middleware que permite la internacionalizacion

    Route::prefix('SSTSENA')->group(function() {
        Route::get('/welcome', 'SSTSENAController@admin')->name('sstsena.admin.welcome');
        Route::get('/prueba', 'SSTSENAController@pruebas')->name('sstsena.funcionario.pruebas');

        Route::prefix('injuty_types')->group(function() {
            Route::get('/', [InjuryTypeController::class,"index"])->name('sstsena.admin.injury_types.index');
            Route::get('/create', [InjuryTypeController::class,"create"])->name('sstsena.admin.injury_types.create');
            Route::post('/store', [InjuryTypeController::class,"store"])->name('sstsena.admin.injury_types.store'); 
            Route::get('/{id}/edit', [InjuryTypeController::class,"edit"])->name('sstsena.admin.injury_types.edit');
            Route::put('/{id}/update', [InjuryTypeController::class,"update"])->name('sstsena.admin.injury_types.update');

        });
    });
});
