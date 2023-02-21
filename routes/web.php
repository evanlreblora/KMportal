<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// match any routes
Route::get('{path}',[App\Http\Controllers\HomeController::class, 'index'])->where( 'path', '([A-z\/_.\d-]+)?' );
// Route::get('/{view?}', 'Controller@landing')->where('view', '(.*)')->name('welcome');

 