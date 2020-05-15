<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/','TrangChu@home');
Route::get('/HomePage','TrangChu@home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/pages', 'Admin\PagesController');
Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
    'index', 'show', 'destroy'
]);
Route::resource('admin/settings', 'Admin\SettingsController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('admin/customer', 'Admin\\CustomerController');
Route::resource('admin/orders', 'Admin\\OrdersController');
Route::resource('admin/products', 'Admin\\ProductsController');
Route::resource('admin/images', 'Admin\\ImagesController');
Route::resource('admin/catalog', 'Admin\\CatalogController');
Route::resource('admin/comment', 'Admin\\CommentController');

Route::get('/san-pham/{slug}', 'Admin\\ProductsController@display' );
Route::get('/{slug}','Admin\\ProductsControllerr@productbycatalog' );

Route::get('/catalog/{id}/active', 'Admin\\CatalogController@isActive')->name('update_active');