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

Route::get('/socios/{socio}', 'SocioController@show')->name('socios.show');

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');
