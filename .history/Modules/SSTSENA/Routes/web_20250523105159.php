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
Route::middleware(['lang'])->group(function () { //Middleware que permite la internacionalizacion

    Route::prefix('SSTSENA')->group(function() {
        Route::get('/index', 'SSTSENAController@index')->name('cefa.sstsena.index');
        Route::get('/welcome', 'SSTSENAController@admin')->name('sstsena.admin.welcome');
        Route::get('/prueba', 'SSTSENAController@pruebas')->name('sstsena.funcionario.pruebas');

        Route::prefix('injuty_types')->group(function() {
            Route::get('/', [InjuryTypeController::class,""])->name('sstsena.admin.injury_types.index');
            Route::get('/create', 'InjuryTypeController@create')->name('sstsena.admin.injury_types.create');
            Route::post('/store', 'InjuryTypeController@store')->name('sstsena.admin.injury_types.store');
            Route::get('/{injury_type}/edit', 'InjuryTypeController@edit')->name('sstsena.admin.injury_types.edit');
            Route::put('/{injury_type}/update', 'InjuryTypeController@update')->name('sstsena.admin.injury_types.update');
            Route::delete('/{injury_type}/destroy', 'InjuryTypeController@destroy')->name('sstsena.admin.injury_types.destroy');
        });
    });
});
