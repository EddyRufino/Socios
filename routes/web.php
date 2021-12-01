<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login');

Route::middleware('can:admin')->group( function () {
    Route::get('/buscar-socio', 'Search\SearchSocioController')->name('search.socio');
    Route::post('/check-qr/{socio}', 'CheckQrSocioController')->name('check.socio');
    // Socios
    Route::get('/socios', 'SocioController@index')->name('socios.index');
    Route::post('/socios', 'SocioController@store')->name('socios.store');
    Route::get('/socios/create', 'SocioController@create')->name('socios.create');
    Route::put('/socios/{socio}', 'SocioController@update')->name('socios.update');
    Route::delete('/socios/{socio}', 'SocioController@destroy')->name('socios.destroy');
    Route::get('/socios/{socio}/edit', 'SocioController@edit')->name('socios.edit');

    // Usuario
    Route::get('profile', 'ProfileController@edit')
                ->name('profile.edit');

    Route::put('profile', 'ProfileController@update')
            ->name('profile.update');
});

// Generate Carnet PDF
Route::get('carnet/{anverso}', 'Report\CarnetController@anverso')->name('carnet.anverso');

Route::get('/socios/{socio}', 'SocioController@show')->name('socios.show');


// Tarjetas
Route::middleware('can:admin')->group( function () {
    // Generate Carnet Circulación PDF
    Route::get('tarjeta/{anverso}', 'Report\CarnetTarjetaController@anverso')->name('tarjeta.anverso');

    Route::get('/buscar-tarjeta-circulacion', 'Search\SearchTarjetaController')->name('search.tarjeta');
    Route::post('/check-qr-tarjeta/{tarjeta}', 'Checks\CheckQrTarjetaController')->name('check.tarjeta');
    // Socios
    Route::get('/socios-tarjetas', 'TarjetaController@index')->name('tarjetas.index');
    Route::post('/socios-tarjetas', 'TarjetaController@store')->name('tarjetas.store');
    Route::get('/socios-tarjetas/create', 'TarjetaController@create')->name('tarjetas.create');
    Route::put('/socios-tarjetas/{tarjeta}', 'TarjetaController@update')->name('tarjetas.update');
    Route::delete('/socios-tarjetas/{tarjeta}', 'TarjetaController@destroy')->name('tarjetas.destroy');
    Route::get('/socios-tarjetas/{tarjeta}/edit', 'TarjetaController@edit')->name('tarjetas.edit');
});

Route::get('/tarjeta-circulacion/{socio}', 'TarjetaController@show')->name('tarjetas.show');

// Fotochecks
Route::middleware('can:admin')->group( function () {
    // Generate Fotocheck PDF
    Route::get('fotocheck/{anverso}', 'Report\CarnetFotocheckController@anverso')->name('fotocheck.anverso');

    Route::get('/buscar-fotocheck', 'Search\SearchFotocheckController')->name('search.fotocheck');
    Route::post('/check-qr-fotocheck/{fotocheck}', 'Checks\CheckQrFotocheckController')->name('check.fotocheck');
    // Socios
    Route::get('/socios-fotochecks', 'FotocheckController@index')->name('fotochecks.index');
    Route::post('/socios-fotochecks', 'FotocheckController@store')->name('fotochecks.store');
    Route::get('/socios-fotochecks/create', 'FotocheckController@create')->name('fotochecks.create');
    Route::put('/socios-fotochecks/{fotocheck}', 'FotocheckController@update')->name('fotochecks.update');
    Route::delete('/socios-fotochecks/{fotocheck}', 'FotocheckController@destroy')->name('fotochecks.destroy');
    Route::get('/socios-fotochecks/{fotocheck}/edit', 'FotocheckController@edit')->name('fotochecks.edit');

    //Asociaciones
    Route::get('/asociaciones', 'AsociacioneController@index')->name('asociaciones.index');
    Route::post('/asociaciones', 'AsociacioneController@store')->name('asociaciones.store');
    Route::get('/asociaciones/create', 'AsociacioneController@create')->name('asociaciones.create');
    Route::put('/asociaciones/{asociacione}', 'AsociacioneController@update')->name('asociaciones.update');
    //Route::delete('/asociaciones/{socio}', 'AsociacioneController@destroy')->name('asociaciones.destroy');
    Route::get('/asociaciones/{asociacione}/edit', 'AsociacioneController@edit')->name('asociaciones.edit');

    // Número Correlativo
    Route::resource('correlativos', 'CorrelativoController')->except(['show', 'destroy']);

    // Search Advanced
    Route::get('/buscar-advanced', 'Search\SearchAdvanceController@advanced')->name('search.advanced');
    Route::get('/buscar-advanced-tree', 'Search\SearchAdvanceController@advancedTree')->name('search.advanced.tree');
    Route::get('/buscar-advanced-two', 'Search\SearchAdvanceController@advancedTwo')->name('search.advanced.two');

    // Export Socios PDF
    Route::get('socios-pdf/{id}', 'Export\ExportSocioController')->name('socio.pdf');

    // Export Socios EXCEL
    Route::get('socios-excel/{id}', 'Export\ExportSocioExcelController')->name('socio.excel');

    // Export Tarjetas que tiene cada asociación
    //Route::get('tarjetas-pdf/{id}', 'Export\ExportTarjetasController')->name('tarjeta.pdf');
    Route::get('tarjetas-excel/{id}', 'Export\ExportTarjetasExcelController')->name('tarjeta.excel');
    Route::get('fotochecks-excel/{id}', 'Export\ExportFotochecksExcelController')->name('fotocheck.excel');

    // Export Socios Oficiales EXCEL
    Route::get('/socios-todo-excel', 'Export\ExportTodosSociosExcelController')->name('todo.socio.excel');
    Route::get('/tarjetas-todo-excel', 'Export\ExportTodosTarjetasExcelController')->name('todo.tarjeta.excel');
    Route::get('/fotochecks-todo-excel', 'Export\ExportTodosFotochecksExcelController')->name('todo.fotocheck.excel');
});

Route::get('/socios-fotochecks/{fotocheck}', 'FotocheckController@show')->name('fotochecks.show');

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');
