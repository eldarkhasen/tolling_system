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

Route::get('/', function () {
    return redirect('/cars');
});

Auth::routes();
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'middleware'=>'admin'], function () {

    Route::resources([
        'users' => 'UsersController',
        'roads' => 'RoadsController'
    ]);

});

Route::group(['namespace' => 'User', 'middleware'=>'auth'], function () {

    Route::resources([
        'cars' => 'CarsController',
//        'roads' => 'RoadsController'
    ]);

    Route::post('/purchases', 'CarsController@storePurchase')->name('storePurchase');
    Route::get('/purchases/{id}/edit', 'CarsController@editPurchase');
});

