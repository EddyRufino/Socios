<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login');

Route::middleware('auth')->group( function () {
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
Route::middleware('auth')->group( function () {
    // Generate Carnet Circulación PDF
    Route::get('tarjeta/{anverso}', 'Report\CarnetTarjetaController@anverso')->name('tarjeta.anverso');

    Route::get('/buscar-tarjeta-circulacion', 'Search\SearchTarjetaController')->name('search.tarjeta');
    Route::post('/check-qr-tarjeta/{tarjeta}', 'Checks\CheckQrTarjetaController')->name('check.tarjeta');
    Route::post('/check-renovar-tarjeta/{tarjeta}', 'Checks\CheckRenovarTarjetaController')->name('renovar.tarjeta');

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
Route::middleware('auth')->group( function () {
    // Generate Fotocheck PDF
    Route::get('fotocheck/{anverso}', 'Report\CarnetFotocheckController@anverso')->name('fotocheck.anverso');

    Route::get('/buscar-fotocheck', 'Search\SearchFotocheckController')->name('search.fotocheck');
    Route::post('/check-qr-fotocheck/{fotocheck}', 'Checks\CheckQrFotocheckController')->name('check.fotocheck');
    Route::post('/check-renovar-fotocheck/{fotocheck}', 'Checks\CheckRenovarFotocheckController')->name('renovar.fotocheck');

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
    // EXCEL
    Route::get('tarjetas-excel/{id}', 'Export\ExportTarjetasExcelController')->name('tarjeta.excel');
    Route::get('fotochecks-excel/{id}', 'Export\ExportFotochecksExcelController')->name('fotocheck.excel');
    // PDF
    Route::get('tarjetas-pdf/{id}', 'Export\Pdf\SociosPdfController@tarjetas')->name('tarjeta.pdf');
    Route::get('fotochecks-pdf/{id}', 'Export\Pdf\SociosPdfController@fotochecks')->name('fotocheck.pdf');

    // Export Socios Oficiales EXCEL
    Route::get('/socios-todo-excel', 'Export\ExportTodosSociosExcelController')->name('todo.socio.excel');
    Route::get('/tarjetas-todo-excel', 'Export\ExportTodosTarjetasExcelController')->name('todo.tarjeta.excel');
    Route::get('/fotochecks-todo-excel', 'Export\ExportTodosFotochecksExcelController')->name('todo.fotocheck.excel');

    // Export Socios Oficiales PDF
    Route::get('/socios-todos-pdf', 'Export\Pdf\AllSociosPdfController@allSocios')->name('todo.socio.pdf');
    Route::get('/tarjetas-todos-pdf', 'Export\Pdf\AllSociosPdfController@allTarjetas')->name('todo.tarjeta.pdf');
    Route::get('/fotochecks-todos-pdf', 'Export\Pdf\AllSociosPdfController@allFotochecks')->name('todo.fotocheck.pdf');
});

Route::get('/socios-fotochecks/{fotocheck}', 'FotocheckController@show')->name('fotochecks.show');


// Template
// Route::view('/admin', 'admin.dashboard')->name('admin.template');

Route::resource('admin/users', 'UserController');

Route::resource('admin/disenios', 'DisenioController');
Route::resource('admin/suministros', 'SuministroController');

Route::resource('admin/areas', 'AreaController')->only(['index', 'edit', 'update']);

// Tarjetas
Route::get('bitacora-tarjetas', 'BitacoraController@indexTarjeta')->name('bitacora.indexTarjeta');
Route::get('bitacora-tarjetas/{id}', 'BitacoraController@showTarjeta')->name('bitacora.showTarjeta');

// Fotochecks
Route::get('bitacora-fotochecks', 'BitacoraController@indexFotocheck')->name('bitacora.indexFotocheck');
Route::get('bitacora-fotochecks/{id}', 'BitacoraController@showFotocheck')->name('bitacora.showFotocheck');

Route::get('admin/socios-delete', 'Export\Pdf\SociosDeletePdfController@sociosIndex')->name('socios.delete');
Route::get('admin/tarjetas-delete', 'Export\Pdf\SociosDeletePdfController@tarjetasIndex')->name('tarjetas.delete');
Route::get('admin/fotochecks-delete', 'Export\Pdf\SociosDeletePdfController@fotochecksIndex')->name('fotochecks.delete');

Route::get('admin/socios-delete-pdf', 'Export\Pdf\SociosDeletePdfController@socios')->name('socios.delete.pdf');
Route::get('admin/tarjetas-delete-pdf', 'Export\Pdf\SociosDeletePdfController@tarjetas')->name('tarjetas.delete.pdf');
Route::get('admin/fotochecks-delete-pdf', 'Export\Pdf\SociosDeletePdfController@fotochecks')->name('fotochecks.delete.pdf');

Route::get('admin/filtros-socios', 'Export\Filtro\ViewFiltroController@createSocios')->name('filtro.socio.create');
Route::get('admin/filtro', 'Export\Filtro\ViewFiltroController@storeSocios')->name('filtro.socio.store');
Route::get('admin/filtro-pdf', 'Export\Filtro\Pdf\PdfFiltroController@pdfFiltroSocioInfo')->name('filtro.socio.pdf.info');
// Route::get('admin/filtro-pdf-graficos', 'Export\Filtro\Pdf\PdfFiltroController@pdfFiltroSocioGrafico')->name('filtro.socio.pdf.grafi');
Route::get('admin/filtro-excel', 'Export\Filtro\Pdf\PdfFiltroController@excelFiltroSocioInfo')->name('filtro.socio.excel.info');

Route::get('admin/suministro-pdf', 'Export\Suministro\PdfSuministroController')->name('suministro.pdf');
Route::get('admin/suministro-excel', 'Export\Suministro\ExcelSuministroController')->name('suministro.excel');

// Charts
// Route::get('/admin', 'Dashboard\dashboardController@index')->name('admin.template');
Route::get('/admin-dashboard-tarjetas', 'Dashboard\dashboardTarjetaController')->name('admin.dashboard.tarjeta');
Route::get('/admin-dashboard-fotochecks', 'Dashboard\dashboardFotocheckController')->name('admin.dashboard.fotocheck');
Route::get('/admin-dashboard-socios', 'Dashboard\dashboardSocioController')->name('admin.dashboard.socio');
Route::get('/admin-dashboard-suministros', 'Dashboard\dashboardSuministroController')->name('admin.dashboard.suministro');

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');
