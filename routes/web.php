<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
    return view('auth/login');
});

// Auth::routes();
Auth::routes(['register' => false]);

Route::middleware(['auth','has.role'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::middleware('permission:create post')->group(function () {
        Route::view('posts/create', 'posts.create');
        Route::view('posts/table', 'posts.table');
        Route::view('categories/create', 'categories.create');
        Route::view('categories/table', 'categories.table');
    });

    Route::prefix('master')->namespace('Admin')->middleware('permission:assign permission')->group(function () {
        Route::get('/users/index', 'UserController@index')->name('users.index');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::post('/users/create', 'UserController@storeUser');
        Route::get('/users/{users}/edit', 'UserController@editUser')->name('users.edit');
        Route::put('/users/{users}/edit', 'UserController@updateUser');
    });

    Route::prefix('role-and-permission')->namespace('Permissions')->middleware('permission:assign permission')->group(function () {
        Route::get('assignable', 'AssignController@create')->name('assign.create');
        Route::post('assignable', 'AssignController@store');
        Route::get('assignable/{role}/edit', 'AssignController@edit')->name('assign.edit');
        Route::put('assignable/{role}/edit', 'AssignController@update');

        // User
        Route::get('assign/user', 'UserController@create')->name('assign.user.create');
        Route::post('assign/user', 'UserController@store');
        Route::get('assign/{user}/user', 'UserController@edit')->name('assign.user.edit');
        Route::put('assign/{user}/user', 'UserController@update');

        Route::prefix('roles')->group(function () {
            Route::get('', 'RoleController@index')->name('roles.index');
            Route::post('create', 'RoleController@store')->name('roles.create');
            Route::get('{role}/edit', 'RoleController@edit')->name('roles.edit');
            Route::put('{role}/edit', 'RoleController@update');
        });
        Route::prefix('permissions')->group(function () {
            Route::get('', 'PermissionController@index')->name('permissions.index');
            Route::post('create', 'PermissionController@store')->name('permissions.create');
            Route::get('{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
            Route::put('{permission}/edit', 'PermissionController@update');
        });
    });

    Route::prefix('navigation')->middleware('permission:create navigation')->group(function () {
        Route::get('create', 'NavigationController@create')->name('navigation.create');
        Route::post('create', 'NavigationController@store');
        Route::get('table', 'NavigationController@table')->name('navigation.table');
        Route::get('{navigation}/edit', 'NavigationController@edit')->name('navigation.edit');
        Route::put('{navigation}/edit', 'NavigationController@update');
        Route::delete('{navigation}/delete', 'NavigationController@destroy')->name('navigation.delete');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
