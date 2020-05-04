<?php
use App\Http\Controllers\Admin\LanguageController;

Route::get('login', 'Auth\\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\\LoginController@loginUser');
Route::post('logout', 'Auth\\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['auth:admin']], function () {
  // Route url
  Route::get('/dashboard', 'DashboardController@dashboardAnalytics')->name('dashboard');

  Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/datatables', 'UserController@datatable')->name('user.datatable');
  });

  // Access controller
  Route::get('/access-control', 'AccessController@index');
  Route::get('/access-control/{roles}', 'AccessController@roles');
  Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');

  // Auth::routes();

  // locale Route
  Route::get('lang/{locale}',[LanguageController::class,'swap']);

});
