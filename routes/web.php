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

Route::view('/', 'auth.login');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/nomina', 'HomeController@nomina')->name('nomina');
	Route::get('/requisiciones', 'HomeController@requisiciones')->name('requisiciones');
	Route::resource('user', 'Admin\UserController', ['except' => ['destroy']]);
	Route::get('users/list', 'Admin\UserController@list')->name('user.list');
	Route::put('users/{id}', 'Admin\UserController@active')->name('user.active');
	Route::get('users/search', 'Admin\UserController@search')->name('user.search');

	//Roles
	Route::get('role/list', 'RoleController@list')->name('role.list');
	Route::get('role/search', 'RoleController@search')->name('role.search');
	Route::view('roles', 'role.role')->name('roles.create');
	Route::post('role', 'RoleController@store')->name('role.store');
	Route::put('role/{id}', 'RoleController@update')->name('role.update');
	Route::delete('role/{id}', 'RoleController@destroy')->name('role.destroy');
	Route::get('role/{id}', 'RoleController@show')->name('role.show');

	Route::view('assingroles', 'users.assingrole')->name('roles.assing');
	Route::post('assingrole/{iduser}/{idrole}', 'RoleController@assingrole')->name('role.assingrole');
	Route::get('rolexuser/{id}', 'RoleController@rolexuser')->name('role.rolexuser');
	Route::delete('destroyrole/{iduser}/{idrole}', 'RoleController@destroyrole')->name('role.destroyrole');

	//Permisos
	Route::view('permissions', 'permission.permission')->name('permissions.create');
	Route::view('assingpermissions/nomina', 'nomina.assingpermission')->name('permissions.assing.nomina');
	Route::view('assingpermissions/requisiciones', 'requisiciones.assingpermission')->name('permissions.assing.requisiciones');
	Route::get('permission/list', 'PermissionController@list')->name('permission.list');
	Route::get('permissionxgroup/{group}', 'PermissionController@permissionxgroup')->name('permission.permissionxgroup');
	Route::get('permissionxrole/{id}/{modulo}', 'PermissionController@permissionxrole')->name('permission.permissionxrole');
	Route::post('permission', 'PermissionController@store')->name('permission.store');
	Route::put('permission/{id}', 'PermissionController@update')->name('permission.update');
	Route::delete('permission/{id}', 'PermissionController@destroy')->name('permission.destroy');
	Route::post('assingpermission/{idrole}/{idpermission}', 'PermissionController@assingpermission')->name('permission.assingpermission');
	Route::delete('destroypermission/{idrole}/{idpermission}', 'PermissionController@destroypermission')->name('permission.destroypermission');

	//Centros de Operación
	Route::resource('destination', 'Admin\DestinationController', ['except' => ['create', 'show', 'edit', 'destroy']]);
	Route::get('destination/list/{status}', 'Admin\DestinationController@list')->name('destination.list');

	//novelty
	// Route::get('/nomina/novelty/prueba/{id}', 'Nomina\NoveltyController@prueba');
	Route::get('/nomina/novelty/pdf/{id}', 'Nomina\NoveltyController@pdf')->name('novelty.pdf');
	Route::get('/nomina/novelty/excel/{id}', 'Nomina\NoveltyController@excel')->name('novelty.excel');
	Route::get('/nomina/novelty/list', 'Nomina\NoveltyController@list')->name('novelty.list');
	Route::resource('/nomina/novelty', 'Nomina\NoveltyController', ['except' => ['show', 'edit']]);
	//Libranzas
	Route::resource('/nomina/libranza', 'Nomina\LibranzaController', ['except' => ['show', 'destroy', 'edit']]);
	Route::post('/nomina/libranzas/amortizar', 'Nomina\LibranzaController@amortizar')->name('libranza.amortizar');
	Route::get('/nomina/libranzas/list/{status}', 'Nomina\LibranzaController@list')->name('libranza.list');
	Route::put('/nomina/libranzas/{id}', 'Nomina\LibranzaController@active')->name('libranza.active');

	//Amortizaciones
	Route::get('/nomina/tbamortizacion', 'Nomina\AmortizacionController@tbAmortizacion')->name('tbAmortizacion.tbAmortizacion');
	Route::get('/nomina/tbamortizaciones', 'Nomina\AmortizacionController@getAmortizaciones')->name('tbamortizacion.getAdmortizaciones');
	Route::get('/nomina/tbamortizacion/{id}/{category}', 'Nomina\AmortizacionController@amortizacionEmployee')->name('tbamortizacion.amortizacionEmployee');
	Route::get('/nomina/addtbamortizacion', 'Nomina\AmortizacionController@getaddtbamortizacion')->name('getaddtbamortizacion');
	Route::post('/nomina/addtbamortizacion', 'Nomina\AmortizacionController@addtbamortizacion')->name('amortizacion.addTbAmortizacion');
	Route::resource('/nomina/tbamortizacion', 'Nomina\AmortizacionController', ['except' => ['index', 'show', 'edit', 'store', 'create']]);
	// Route::get('/nomina/novelty/list', 'Nomina\EmployeeController@list');

	//Employee
	Route::resource('employee', 'Nomina\EmployeeController', ['except' => ['edit', 'destroy']]);
	Route::get('employees/list/{status}', 'Nomina\EmployeeController@list')->name('employees.list');
	Route::get('employees/search', 'Nomina\EmployeeController@search')->name('employees.search');

	//Holidays
	Route::resource('/nomina/holiday', 'Nomina\HolidayController', ['except' => ['show', 'edit']]);
	Route::get('/nomina/holidays/list', 'Nomina\HolidayController@list')->name('holiday.list');
	//TNL
	Route::resource('/nomina/tnl', 'Nomina\TNLController', ['except' => ['show', 'edit']]);
	Route::get('/nomina/tnls/list', 'Nomina\TNLController@list')->name('tnl.list');
	//HE
	Route::resource('/nomina/he', 'Nomina\HEController', ['except' => ['show', 'edit']]);
	Route::get('/nomina/hes/list', 'Nomina\HEController@list')->name('he.list');
	//Retention
	Route::resource('/nomina/retention', 'Nomina\RetentionController', ['except' => ['show', 'edit']]);
	Route::get('/nomina/retentions/list', 'Nomina\RetentionController@list')->name('retention.list');

	//Rutas de requisiciones
	require __DIR__.'\routes_requisiciones.php';
});
