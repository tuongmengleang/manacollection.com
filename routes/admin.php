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
    Route::post('/store', "UserController@store")->name('user.store');
    Route::post('/delete', "UserController@destroy")->name('user.delete');
    Route::get('/edit', "UserController@edit")->name('user.edit');
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
    Route::get('/permissions', "RoleController@getPermissions")->name('role.get.permissions');
  });

  Route::prefix('settings')->group(function () {
//    Route::get('/', 'SettingController@index')->name('setting.index');
    Route::post('/', 'SettingController@update')->name('setting.update');

    // Route setting Tap
    Route::get('/', 'SettingController@general')->name('setting.general');
    Route::get('/social-link', 'SettingController@social_link')->name('setting.social_link');
    Route::get('/notification', 'SettingController@notification')->name('setting.notification');
    Route::get('/permission', 'SettingController@permission')->name('setting.permission');
    Route::get('/role', 'SettingController@role')->name('setting.role');
  });

  // Product category
  Route::prefix('categories')->group(function (){
    Route::get('/', "ProductCategoryController@index")->name('product.category.index');
    Route::get('/datatables', "ProductCategoryController@datatable")->name('product.category.datatable');
    Route::post('/store', "ProductCategoryController@store")->name('product.category.store');
    Route::post('/delete', "ProductCategoryController@destroy")->name('product.category.delete');
    Route::get('/edit', "ProductCategoryController@edit")->name('product.category.edit');
  });
  // Product subcategory
  Route::prefix('subcategories')->group(function (){
    Route::get('/', "ProductSubcategoryController@index")->name('product.subcategory.index');
    Route::get('/datatables', "ProductSubcategoryController@datatable")->name('product.subcategory.datatable');
    Route::post('/store', "ProductSubcategoryController@store")->name('product.subcategory.store');
    Route::post('/delete', "ProductSubcategoryController@destroy")->name('product.subcategory.delete');
    Route::get('/edit', "ProductSubcategoryController@edit")->name('product.subcategory.edit');
  });

  // Product brand
  Route::prefix('brands')->group(function (){
    Route::get('/', "BrandController@index")->name('product.brand.index');
    Route::get('/datatables', "BrandController@datatable")->name('product.brand.datatable');
    Route::post('/store', "BrandController@store")->name('product.brand.store');
    Route::get('/edit', "BrandController@edit")->name('product.brand.edit');
    Route::post('/delete', "BrandController@destroy")->name('product.brand.delete');
    Route::get('/view', "BrandController@edit")->name('product.brand.view');
  });

  // Product
  Route::prefix('products')->group(function (){
    Route::get('/', "ProductController@index")->name('product.index');
    Route::get('/datatables', "ProductController@datatable")->name('product.datatable');
    Route::post('/store', "ProductController@store")->name('product.store');
    Route::post('/upload', "ProductController@upload")->name('product.upload');
    Route::get('/edit', "ProductController@edit")->name('product.edit');
    Route::post('/delete', "ProductController@destroy")->name('product.delete');
    Route::get('/subcategory', "ProductController@getSubcategory")->name('product.get.subcategory');
    Route::post('/delete/image', "ProductController@deleteProductImage")->name('product.delete.image');
    Route::post('/status', "ProductController@changeStatus")->name('product.status');
    Route::get('/view', "ProductController@edit")->name('product.product.view');
  });

  Route::prefix('product-stock')->group(function (){
    Route::get('/', "ProductStockController@index")->name('product.stock.index');
  });
});
