<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Modules\Car\Models\Car;

Route::get('ars', function () {
    return Car::find(1)->vehicle_category;
});

Route::get('/intro', 'LandingpageController@index');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/install/check-db', 'HomeController@checkConnectDatabase');

Route::get('/update', function () {
    return redirect('/');
});

//Cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cleared!";
});

//Login
Auth::routes();
//Custom User Login and Register
Route::post('register', '\Modules\User\Controllers\UserController@userRegister')->name('auth.register');
Route::post('login', '\Modules\User\Controllers\UserController@userLogin')->name('auth.login');
Route::post('logout', '\Modules\User\Controllers\UserController@logout')->name('auth.logout');
//Social Login
Route::get('social-login/{provider}', 'Auth\LoginController@socialLogin');
Route::get('social-callback/{provider}', 'Auth\LoginController@socialCallBack');

//Logs
Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth', 'dashboard', 'system_log_view']);

//save subscriber
Route::post('admin/module/user/subscriber/store', '\Modules\User\Admin\SubscriberController@saveSubscriber')->name('save.subscriber');

//driver vehicle route
Route::get('/user/vehicle/driver', 'VehicleDriverController@index')->name('vehicle.driver.get');
Route::get('/user/vehicle/driver/create', 'VehicleDriverController@create')->name('vehicle.driver.create');
Route::post('/user/vehicle/driver/create', 'VehicleDriverController@store')->name('vehicle.driver.store');
Route::post('/user/vehicle/driver/status', 'VehicleDriverController@status')->name('vehicle.driver.status');
Route::post('/user/vehicle/driver/delete', 'VehicleDriverController@delete')->name('vehicle.driver.delete');
Route::get('/user/vehicle/driver/{id}', 'VehicleDriverController@show')->name('vehicle.driver.show');
Route::get('/user/vehicle/driver/edit/{id}', 'VehicleDriverController@edit')->name('vehicle.driver.edit');
Route::put('/user/vehicle/driver/update/{id}', 'VehicleDriverController@update')->name('vehicle.driver.update');

//Administrator: Username: admin@dev.com / Pass: admin123

//Admin Module Roue
//vehicle drive
Route::name('admin.')
    ->namespace('Admin')
    ->prefix('admin/module')
    ->group(function () {

        Route::get('vehicle/driver', 'VehicleController@index')->name('driver.get');
        Route::post('driver/status', 'VehicleController@status')->name('driver.status');
        Route::get('/driver/{id}', 'VehicleController@show')->name('driver.show');
        Route::post('/driver/assign', 'VehicleController@assignDriver')->name('assign.driver');

        //vehicle category
        Route::get('vehicle/categories', 'VehicleCategoryController@index')->name('vehicle.category.get');
        Route::get('vehicle/categories/create', 'VehicleCategoryController@create')->name('vehicle.category.create');
        Route::post('vehicle/categories/create', 'VehicleCategoryController@store');
        Route::get('vehicle/categories/edit/{id}', 'VehicleCategoryController@edit')->name('vehicle.category.edit');
        Route::put('vehicle/categories/edit/{id}', 'VehicleCategoryController@update');

        //vehicle category
        Route::get('car/body/type', 'CarBodyTypeController@index')->name('vehicle.car.bodytype.get');
        Route::get('car/body/type/create', 'CarBodyTypeController@create')->name('vehicle.car.bodytype.create');
        Route::post('car/body/type/create', 'CarBodyTypeController@store');
        Route::get('car/body/type/edit/{id}', 'CarBodyTypeController@edit')->name('vehicle.car.bodytype.edit');
        Route::put('car/body/type/edit/{id}', 'CarBodyTypeController@update');
    });
