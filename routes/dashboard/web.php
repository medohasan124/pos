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


Route::get('logOut', function(){
	Auth::logout();
  return redirect('/');
})->name('logOut');


});






