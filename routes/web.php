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
    return view('auth.login');
});

Route::get('test', function () {
    return view('backend.receipt.invoice');
});

Route::get('/login', array(
    'as'    => 'login',
    'uses'  => 'Auth\LoginController@login'
));

Route::post('/post-login', array(
    'as'    => 'postLogin',
    'uses'  => 'Auth\LoginController@postLogin'
));

Auth::routes();

Route::get('/force-logout', array(
    'as'    => 'forceLogout',
    'uses'  => 'Auth\LoginController@forceLogout'
));

// route access permission optional for action if data null true by default
Route::group(['middleware' => 'sentinelAuth','namespace' => 'Admin','prefix' => 'account'], function () {
    Route::get('change-password', 'AccountController@changePassword')->name('account.change_password');
    Route::put('change-password', 'AccountController@postChangePassword')->name('account.post_change_password');
});

// route access permission required for action default is false
Route::group(['middleware' => ['sentinelAuth','checkAccess'],'namespace' => 'Admin','prefix' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('role', 'RoleController')->except('show');
    Route::resource('permission', 'PermissionController')->only(['index','edit','update']);
    Route::resource('user', 'UserController')->except('show');
    Route::resource('settings', 'SettingController')->only(['index','edit','update']);
    Route::resource('member', 'MemberController')->only(['index','edit','update']);
    Route::resource('hub', 'HubController')->except('show');
    Route::resource('product', 'ProductController')->except('show');
    Route::resource('driver', 'DriverController')->except('show');
    Route::resource('vehicle', 'VehicleController')->except('show');
    Route::resource('warehouse', 'WarehouseController')->except('show');
    Route::resource('delivery-order', 'DeliveryOrderController')->except('show');
    Route::resource('delivery-order-detail', 'DeliveryOrderDetailController')->except('show');
    Route::resource('document-assignment', 'DocumentAssignmentController')->except('show');
    Route::post('assign', 'DeliveryOrderController@assign')->name('assign');
    Route::resource('driver-vehicle', 'DriverVehicleController')->except('show');
});
