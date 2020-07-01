<?php
use App\Http\Controllers\Admin\LanguageController;

Route::get('login', 'Auth\\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\\LoginController@loginUser');
Route::post('logout', 'Auth\\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['auth:admin']], function () {
  // locale Route
  Route::get('lang/{locale}',[LanguageController::class,'swap']);

  // Route url
  Route::get('/dashboard', 'DashboardController@dashboardAnalytics')->name('dashboard');

  Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/datatables', 'UserController@datatable')->name('user.datatable');
    Route::get('/export/{type}', 'UserController@export')->name('user.export');
  });

  // Access controller
  Route::get('/access-control', 'AccessController@index');
  Route::get('/access-control/{roles}', 'AccessController@roles');
  Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');

  // Permission user controller
  Route::prefix('permissions')->group(function (){
    Route::get('/', 'PermissionController@index')->name('permission.index');
    Route::get('/datatables', 'PermissionController@datatable')->name('permission.datatable');
    Route::post('/store', 'PermissionController@store')->name('permission.store');
    Route::post('/delete', 'PermissionController@destroy')->name('permission.delete');
    Route::get('/edit', 'PermissionController@edit')->name('permission.edit');
  });

  // roles user controller
  Route::prefix('roles')->group(function (){
    Route::get('/', 'RoleController@index')->name('role.index');
    Route::get('/datatables', 'RoleController@datatable')->name('role.datatable');
    Route::post('/store', 'RoleController@store')->name('role.store');
    Route::post('/delete', 'RoleController@destroy')->name('role.delete');
    Route::get('/edit', 'RoleController@edit')->name('role.edit');
  });

  Route::prefix('settings')->group(function () {
    Route::get('/', 'SettingController@index')->name('setting.index');
    Route::post('/', 'SettingController@update')->name('setting.update');
  });
});
