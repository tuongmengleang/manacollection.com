<?php
use App\Http\Controllers\Admin\LanguageController;

Route::get('login', 'Auth\\LoginController@showLoginForm')->name('auth.login');
Route::post('logout', 'Auth\\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['auth:admin']], function () {
  // Route url
  Route::get('/dashboard', 'DashboardController@dashboardAnalytics')->name('dashboard');

  // Route Dashboards
  Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');

  // Route Components
  Route::get('/sk-layout-2-columns', 'StaterkitController@columns_2');
  Route::get('/sk-layout-fixed-navbar', 'StaterkitController@fixed_navbar');
  Route::get('/sk-layout-floating-navbar', 'StaterkitController@floating_navbar');
  Route::get('/sk-layout-fixed', 'StaterkitController@fixed_layout');

  // Access controller
  Route::get('/access-control', 'AccessController@index');
  Route::get('/access-control/{roles}', 'AccessController@roles');
  Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');

  // Auth::routes();

  // locale Route
  Route::get('lang/{locale}',[LanguageController::class,'swap']);

});
