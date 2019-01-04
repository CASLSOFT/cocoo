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
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/nomina', 'HomeController@nomina')->name('nomina');
Route::resource('user', 'Admin\UserController');
Route::get('users/list', 'Admin\UserController@list');
Route::put('users/{id}', 'Admin\UserController@active');


//novelty
Route::get('/nomina/novelty/pdf/{id}', 'Nomina\NoveltyController@pdf')->name('novelty.pdf');
Route::get('/nomina/novelty/list', 'Nomina\NoveltyController@list')->name('novelty.list');
Route::resource('/nomina/novelty', 'Nomina\NoveltyController');
//Libranzas
Route::resource('/nomina/libranza', 'Nomina\LibranzaController');
Route::post('/nomina/libranzas/amortizar', 'Nomina\LibranzaController@amortizar');
Route::get('/nomina/libranzas/amortizaciones', 'Nomina\LibranzaController@getamortizaciones');
Route::get('/nomina/libranzas/validatefecha', 'Nomina\LibranzaController@validateFechas');
Route::get('/nomina/libranzas/list/{status}', 'Nomina\LibranzaController@list');
Route::put('/nomina/libranzas/{id}', 'Nomina\LibranzaController@active');
// Route::get('/nomina/novelty/list', 'Nomina\EmployeeController@list');
//Employee
Route::resource('employee', 'Nomina\EmployeeController', ['except' => ['edit', 'destroy']]);
Route::get('employees/list', 'Nomina\EmployeeController@list');
Route::get('employees/search', 'Nomina\EmployeeController@search');

//Holidays
Route::resource('/nomina/holiday', 'Nomina\HolidayController');
Route::get('/nomina/holidays/list', 'Nomina\HolidayController@list');
//TNL
Route::resource('/nomina/tnl', 'Nomina\TNLController');
Route::get('/nomina/tnls/list', 'Nomina\TNLController@list');
//HE
Route::resource('/nomina/he', 'Nomina\HEController');
Route::get('/nomina/hes/list', 'Nomina\HEController@list');
//Retention
Route::resource('/nomina/retention', 'Nomina\RetentionController');
Route::get('/nomina/retentions/list', 'Nomina\RetentionController@list');