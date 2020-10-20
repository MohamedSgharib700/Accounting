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

Route::group(['prefix' => '/', 'namespace' => 'Api'], function () {

    Route::post('/login', 'PassportController@login')->name('api.login');
    Route::get('/unauthenticated', 'PassportController@unauthenticated')->name('api.unauthenticated');
    Route::post('/register', 'PassportController@register')->name('api.register');
    Route::post('/enter-email-reset', 'PassportController@enterEmailReset')->name('api.enterEmailReset');
    Route::get('find/{token}', 'PassportController@find');
    Route::post('reset-password', 'PassportController@reset');
    Route::group(['prefix' => '/generals', ], function () {
        Route::get('/get-areas', 'GeneralsController@GetAreas')->name('api.GetAreas');
        Route::get('/get-delegates', 'GeneralsController@GetDelegates')->name('api.GetDelegates');
        Route::get('/get-pos-areas', 'GeneralsController@GetPosAreas')->name('api.GetPosAreas');

    });
});
Route::group(['middleware'=> ['auth:api', 'CheckActivity'], 'prefix' => '/', 'namespace' => 'Api'], function () {

    Route::get('/logout', 'PassportController@logout')->name('api.logout');
    Route::get('/get-pos', 'GeneralsController@GetPos')->name('api.GetPos');
    Route::group(['prefix' => '/client', ], function () {
        Route::post('/register', 'ClientsController@register')->name('api.Clientregister');
        Route::get('/get-clients', 'ClientsController@GetClients')->name('api.GetClients');

    });
    Route::group(['prefix' => '/delegate', ], function () {
        Route::post('/transfer-credit-from-delegate-to-customer', 'DelegateController@TransferCreditFromDelegateToCustomer')->name('api.SendMoney');
        Route::get('/get-transfer-credit-from-delegate-to-customer', 'DelegateController@getTransferCreditFromDelegateToCustomer')->name('api.GetSendMoney');
        Route::get('/get-transactions', 'DelegateController@GetTransactions')->name('api.GetTransactions');
        Route::post('/send-from-delegate-to-banks', 'DelegateController@SendFromDelegateToBanks')->name('api.SendFromDelegateToBanks');
        Route::get('/get-send-from-delegate-to-banks', 'DelegateController@GetSendFromDelegateToBanks')->name('api.GetSendFromDelegateToBanks');
        Route::post('/accept-refund-of-money', 'DelegateController@AcceptRefundOfMoney')->name('api.AcceptRefundOfMoney');

    });
    Route::group(['prefix' => '/client', ], function () {
        Route::post('/refund-money-from-client-to-delegate', 'ClientsController@RefundMoneyFromClientToDelegate')->name('api.RefundMoneyFromClientToDelegate');
        Route::get('/get-refund-money-from-client-to-delegate', 'ClientsController@GetRefundMoneyFromClientToDelegate')->name('api.GetRefundMoneyFromClientToDelegate');
        Route::post('/transfer-from-machine-to-machines', 'ClientsController@TransferFromMachineToMachines')->name('api.TransferFromMachineToMachines');

    });
});

//https://documenter.getpostman.com/view/3916592/SzzdCgFw?version=latest
