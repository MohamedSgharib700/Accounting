<?php

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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/agent/register', 'Api\UserController@agentRegister');

// Route::post('/agent/login', 'Api\UserController@agentLogin');


// // Route::group(['middleware' => ['auth.admin','auth:customer_api']], function() {

// Route::post('/customer/register', 'Api\UserController@customerRegister');

// Route::post('/customer/login', 'Api\UserController@customerLogin');

// // });



// Route::group(["middleware" => "auth:api"] , function(){
//     Route::get('/agent/{user}', ['uses' => 'Api\AgentsController@details', 'as' => 'api.agent.details']);
//     Route::get('/agent/{user}/pos', ['uses' => 'Api\AgentsController@poss', 'as' => 'api.agent.poss']);
//     Route::get('/pos/statuses', ['uses' => 'Api\AgentsController@posStatuses', 'as' => 'api.pos.statuses']);
//     Route::get('/agent/{user}/balance', ['uses' => 'Api\AgentsController@balance', 'as' => 'api.agent.balance']);
//     Route::get('/agent/{user}/export', ['uses' => 'Api\AgentsController@export', 'as' => 'api.agent.balance.export']);
//     Route::post('/agent/bank-transfer', ['uses' => 'Api\AgentsController@bankTransfer', 'as' => 'api.agent.bank.transfer']);
//     Route::get('/installments/export', ['uses' => 'Api\InstallmentsController@export', 'as' => 'api.installments.export']);
//     Route::resource("installments" , "Api\InstallmentsController")->only(['index','store']);
//     Route::resource("locations" , "Api\LocationsController")->only(['store']);
//     Route::get('/revenues/export', ['uses' => 'Api\RevenuesController@export', 'as' => 'api.revenues.export']);
//     Route::resource("revenues" , "Api\RevenuesController")->only(['index','store']);
// });
