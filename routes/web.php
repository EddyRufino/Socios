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
});

// Generate Carnet PDF
Route::get('carnet/{anverso}', 'Report\CarnetController@anverso')->name('carnet.anverso');

Route::get('/socios/{socio}', 'SocioController@show')->name('socios.show');


// Tarjetas
Route::middleware('can:admin')->group( function () {
    //Route::get('/buscar-socio', 'Search\SearchSocioController')->name('search.socio');
    //Route::post('/check-qr/{socio}', 'CheckQrSocioController')->name('check.socio');
    // Socios
    Route::get('/socios-tarjetas', 'TarjetaController@index')->name('tarjetas.index');
    Route::post('/socios-tarjetas', 'TarjetaController@store')->name('tarjetas.store');
    Route::get('/socios-tarjetas/create', 'TarjetaController@create')->name('tarjetas.create');
    Route::put('/socios-tarjetas/{socio}', 'TarjetaController@update')->name('tarjetas.update');
    Route::delete('/socios-tarjetas/{socio}', 'TarjetaController@destroy')->name('tarjetas.destroy');
    Route::get('/socios-tarjetas/{socio}/edit', 'TarjetaController@edit')->name('tarjetas.edit');
});

Route::get('/socios-tarjetas/{socio}', 'TarjetaController@show')->name('tarjetas.show');

// Fotochecks
Route::middleware('can:admin')->group( function () {
    //Route::get('/buscar-socio', 'Search\SearchSocioController')->name('search.socio');
    //Route::post('/check-qr/{socio}', 'CheckQrSocioController')->name('check.socio');
    // Socios
    Route::get('/socios-fotochecks', 'FotocheckController@index')->name('fotochecks.index');
    Route::post('/socios-fotochecks', 'FotocheckController@store')->name('fotochecks.store');
    Route::get('/socios-fotochecks/create', 'FotocheckController@create')->name('fotochecks.create');
    Route::put('/socios-fotochecks/{socio}', 'FotocheckController@update')->name('fotochecks.update');
    Route::delete('/socios-fotochecks/{socio}', 'FotocheckController@destroy')->name('fotochecks.destroy');
    Route::get('/socios-fotochecks/{socio}/edit', 'FotocheckController@edit')->name('fotochecks.edit');
});

Route::get('/socios-fotochecks/{socio}', 'FotocheckController@show')->name('fotochecks.show');

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');
