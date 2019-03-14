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

Route::get('/', function () {
    $reports = \App\Report::all();

    return view('welcome', compact('reports'));
})->name('home');

Route::get('/reports/create', 'Web\ReportController@create')->name('reports.create');
Route::post('/reports/', 'Web\ReportController@store')->name('reports.store');
Route::patch('/reports/{report}', 'Web\ReportController@update')->name('reports.update');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
//    'middleware' => 'admin',
    'as' => 'admin.',
], function() {
    Route::resource('reports', 'ReportController');
});
