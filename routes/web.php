<?php

use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ClientDataController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\StateController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/clients');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);

    Route::post('country-states', [CountryController::class, 'getStates'])->name('get-states');
    Route::post('state-cities', [CityController::class, 'getCities'])->name('get-cities');

    // API Routes
    Route::group(['prefix' => 'api/'], function () {

        Route::get('clients/countries', [ClientDataController::class, 'countries']);
        Route::get('clients/{country}/states', [ClientDataController::class, 'states']);
        Route::get('clients/{state}/cities', [ClientDataController::class, 'cities']);
        Route::get('clients/departments', [ClientDataController::class, 'departments']);


        Route::resource('clients', ClientController::class);
    });
    Route::any('{any}', function () {
        return view('dashboard.vue.index');
    })->where('any', '.*');
});