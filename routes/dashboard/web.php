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

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' , 'auth' ]
], function(){ 

	
Route::prefix('dashboard')->name('dashboard')->group(function(){

	Route::get('/', function () {
    return view('dashboard.index');
});
});


Route::resource('users', 'UserController');


Route::resource('catigory', 'catigories');
Route::resource('items', 'itemController');
Route::resource('client', 'ClientController');
Route::resource('order', 'order');
Route::post('lastOrder', 'lastOrder@sale')->name('lastOrder');


Route::get('history', 'lastOrder@history')->name('history');
Route::get('/detales/{id}', 'lastOrder@detales')->name('detales');
Route::get('/print/{id}', 'lastOrder@print')->name('print');
Route::post('/singelback/{id}', 'lastOrder@singelback')->name('singelback');
Route::post('/backAll/{id}', 'lastOrder@backAll')->name('backAll');
Route::post('/checkAll/{id}', 'lastOrder@checkAll')->name('checkAll');

Route::resource('settings', 'settingsController');




Route::get('logOut', function(){
	Auth::logout();
  return redirect('/');
})->name('logOut');


});






