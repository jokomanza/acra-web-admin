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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/applications', 'ApplicationController@index')->name('application.index');

Route::post('/application', 'ApplicationController@store')->name('application.store');

Route::delete('/application', 'ApplicationController@destroy')->name('application.destroy');

Route::get('/reports', 'ReportController@index')->name('reports');

Route::get('/report', 'ReportController@showHeader')->name('report');

Route::get('/report/detail', 'ReportController@showDetail')->name('report.detail');

Route::get('/report/{report_id}', 'ReportController@showFullReport')->name('report.full');

