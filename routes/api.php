<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProceedingController;
use App\Http\Controllers\API\PolicyBriefController;
use App\Http\Controllers\API\AnnualReportController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\PublicationController;
use App\Http\Controllers\API\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->get('/proceeding', function (Request $request) {
    return $request->proceeding();
});

Route::middleware('auth:api')->get('/policybrief', function (Request $request) {
    return $request->policybrief();
});

Route::middleware('auth:api')->get('/annualreport', function (Request $request) {
    return $request->annualreport();
});
Route::middleware('auth:api')->get('/projectcompletions', function (Request $request) {
    return $request->projectcompletion();
});

Route::middleware('auth:api')->get('/publications', function (Request $request) {
    return $request->publications();
});



Route::apiResource('users' , UserController::class);
Route::apiResource('proceedings' , ProceedingController::class);
Route::apiResource('policybriefs' , PolicyBriefController::class);
Route::apiResource('annualreports' , AnnualReportController::class);
Route::apiResource('projectcompletions' , ProjectController::class);
Route::apiResource('publications' , PublicationController::class);
Route::apiResource('video' , VideoController::class);
Route::apiResource('abo' , ABOController::class);
Route::apiResource('bimgbdocs' , BIMGBDoxController::class);
Route::apiResource('bimworkshopfiles' , BIMworkshopFilesController::class);
Route::apiResource('kmproducts' , KMProductsController::class);
 



// Route::get("profile",[UserController::class,"profile"]);
// Route::put("profile",[UserController::class,"updateProfile"]);
Route::get('/profile', 'App\Http\Controllers\API\UserController@profile');
Route::put('/profile', 'App\Http\Controllers\API\UserController@updateProfile');

Route::get('/getprofile', 'App\Http\Controllers\API\AnnualReportController@getprofile');


// upload eto dapat
// Route::post('upload', 'App\Http\Controllers\API\ProceedingController@upload');
 

//search
Route::get('/search', 'App\Http\Controllers\API\UserController@search');

Route::get('/searchannualrep', 'App\Http\Controllers\API\AnnualReportController@search');
Route::get('/searchpolicybr', 'App\Http\Controllers\API\PolicyBriefController@search');



