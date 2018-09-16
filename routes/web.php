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

Route::get('/', 'HospitalController@index');
Route::get('/hospital/create', 'HospitalController@create');
Route::post('/hospital/create', 'HospitalController@insert');
Route::get('/hospital/edit', 'HospitalController@edit');
Route::post('/hospital/edit', 'HospitalController@update');
Route::post('/hospital/destroy', 'HospitalController@destroy');

Route::get('/search/hospitals/section', 'HospitalController@searchHospitalsBySectionId');