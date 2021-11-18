<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'App\Http\Controllers\PagesController@welcome')->middleware('auth');


Auth::routes();

Route::middleware([
    'auth', 
])->group(function () {
   
        Route::get('/employees/filter', 'App\Http\Controllers\EmployeeController@filter');
        Route::get('/employees/search', 'App\Http\Controllers\EmployeeController@search');
        Route::resource('/employees', 'App\Http\Controllers\EmployeeController');

        Route::get('/clients/filter', 'App\Http\Controllers\ClientController@filter');
        Route::get('/clients/search', 'App\Http\Controllers\ClientController@search');
        Route::resource('/clients', 'App\Http\Controllers\ClientController');

        Route::resource('/agreement', 'App\Http\Controllers\AgreementsController');
        Route::post('/agreement/addcity', 'App\Http\Controllers\AgreementsController@addcity');
        Route::post('/agreement/addedcity', 'App\Http\Controllers\AgreementsController@addedcity');

        Route::resource('/contract', 'App\Http\Controllers\ContractsController');

        Route::resource('/payment', 'App\Http\Controllers\PaymentsController');

        Route::get('/voucher/getData', 'App\Http\Controllers\VouchersController@getData')->name('voucher.getData');
        Route::resource('/voucher', 'App\Http\Controllers\VouchersController');

        Route::resource('/currency', 'App\Http\Controllers\CurrencyController');

});
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
 
    return "Кэш очищен.";
});
Route::get('/command',function(){ Artisan::call('storage:link'); });
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
