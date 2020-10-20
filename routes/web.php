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
     return view('auth.login');
 });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('dashboard')->namespace('Admin')->middleware(['auth'])->group(function(){

    Route::get('/index', 'ElectricityController@getBalances')->name('dashboard');

    Route::resource('users','UserController');

    Route::resource('customers','CustomerController');

    Route::resource('devices','PosController');

    Route::get('pos/{id}','PosController@show_pos')->name('agents.show-pos');

    Route::get('/show/pos/{id}', ['as' => 'agent.pos.transactions.show', 'uses' => 'PosController@show_pos_transactions']);

    Route::get('/exportexcel/{id}', 'PosController@exportExcel')->name('exportexcel.posTransactions');

    Route::get('/exportpdf/{device}', 'PosController@exportPdf')->name('exportpdf.posTransactions');

    Route::resource('agents','agentcontroller');

    Route::get('transfers_to_bank','agentcontroller@transferToBank')->name('transfers.bank');

    Route::get('treasury','TreasuryController@index')->name('treasury');

    Route::get('/show-balances/{id}', ['as' => 'agent.balances.show', 'uses' => 'BalanceController@show_balances']);

    Route::get('export_balance_pdf/{id}','BalanceController@exportPdfBalance')->name('agent.balance.pdf');

    Route::get('balance/{id}','BalanceController@show_agent')->name('balance.agent');

    Route::get('/balances', 'BalanceController@index')->name('balances.index');

    //  Route::get('/exportexcel/{device}/balances', 'BalanceController@exportExcel')->name('exportexcel.balances');

    // Route::get('/exportpdf/{device}/balances', 'BalanceController@exportPdf')->name('exportpdf.balances');


    Route::resource('balances','BalanceController');

    Route::get('balances_discount','BalanceController@indexBalancesDiscount')->name('balances.discount');

    Route::get('balance_discount','BalanceController@ShowBalancesDiscount')->name('show.balance.discount');

    Route::post('balance/discount','BalanceController@balancesDiscount')->name('discount.action');

    Route::get('balances/create','BalanceController@create')->name('balances.create');



    Route::resource('amwalBalances','AmwalBalanceController');

    Route::resource('expensesBalances','ExpensesController');

    Route::resource('expensesBalanceCategories','ExpensesCategoryController');

    Route::get('/all-transactions', ['as' => 'transactions.show', 'uses' => 'TransactionController@show_transactions']);
    Route::get('/all-transactions-failed', ['as' => 'transactions.failed.show', 'uses' => 'TransactionController@show_transactions_failed']);
    Route::get('/balances-report', ['as' => 'balances-report', 'uses' => 'BalancesReportController@index']);
    Route::get('/agent-balances-report', ['as' => 'agent-balances-report', 'uses' => 'BalancesReportController@show_agent_balances']);
    Route::get('/company-balances-report', ['as' => 'company-balances-report', 'uses' => 'BalancesReportController@show_company_balances']);

    Route::get('/revenues-categories', 'CompanyRevenuesCategoriesController@index')->name('company-revenues-categories');
    Route::post('/revenue-category', 'CompanyRevenuesCategoriesController@store');

    Route::get('/revenues', 'CompanyRevenueController@index')->name('company-revenues');
    Route::post('/revenue', 'CompanyRevenueController@store');
    Route::get('/revenue-report', 'CompanyRevenueController@revenue_report');

    Route::get('/export-all-transactions-failed', [ 'uses' => 'TransactionController@export_failed'])->name('exportpdf.exportAllTransactionsFailed');

    Route::resource('contracts','ContractController');

    Route::resource('installments','InstallmentController');

    Route::post('/amwal-balance', 'AmwalBalanceController@store');
    Route::get('/amwal-report', 'AmwalBalanceController@amwal_report');
    Route::post('/more-balance', ['as' => 'admin.more-balance.insert', 'uses' => 'MoreAgentsBalancesController@store']);
    Route::post('/more-balance-discount', ['as' => 'admin.more-balance.discount', 'uses' => 'MoreAgentsBalancesController@discount']);
    Route::get('/more-balances', 'MoreAgentsBalancesController@index')->name('more-balances');


    Route::get('/userCodes', 'agentcontroller@EditAllCustomerscode')->name('userCodes');
    Route::GET('/userCodes/{user}/edit', 'agentcontroller@edit')->name('userCodes.edit');
    Route::PUT('/userCodes/{user}', 'agentcontroller@update')->name('userCodes.update');

    Route::get('/total-report', 'TotalReportController@index')->name('total-report');
    Route::get('/total-pdf', 'TotalReportController@export_pdf')->name('total-report-pdf');
    Route::get('/total-report-pdf', 'TotalReportController@export_total_pdf')->name('report-pdf');


    Route::get('/exportallagentspdf', 'agentcontroller@exportTotalAllagentsPdf')->name('exportpdf.totalsforallagents');

    Route::get('/export-all-agent-balances', [ 'uses' => 'agentcontroller@export'])->name('agent-balances-excel');
    Route::get('/agent-balances-pdf', 'agentcontroller@export_pdf')->name('agent-balances-pdf');
    Route::get('/agents-pos', 'AgentPosController@index')->name('agents-pos');
    Route::get('/show/{id}', ['as' => 'agent.pos.show', 'uses' => 'AgentPosController@show_pos']);
    Route::get('/show-pos-available/{id}', ['as' => 'agent.pos.available', 'uses' => 'AgentPosController@pos_available']);
    Route::get('/show-pos-customer/{id}', ['as' => 'agent.pos.customer', 'uses' => 'AgentPosController@pos_customer']);

    Route::get('/show/export-all-agent-pos/{id}', [ 'uses' => 'AgentPosController@export'])->name('agent-pos-excel');
    Route::get('/show-pos-available/export-available-agent-pos/{id}', [ 'uses' => 'AgentPosController@export_available_pos'])->name('available-pos-excel');
    Route::get('/show-pos-customer/export-customer-agent-pos/{id}', [ 'uses' => 'AgentPosController@export_customer_pos'])->name('customer-pos-excel');
    Route::get('/all-pos-available', ['as' => 'agent.all.pos.available', 'uses' => 'AgentPosController@all_pos_available']);
    Route::get('/all-pos-customer', ['as' => 'agent.all.pos.customer', 'uses' => 'AgentPosController@all_pos_customer']);
    Route::get('/all-pos-to-refund', ['as' => 'agent.all.pos.to.refund', 'uses' => 'AgentPosController@all_pos_to_refund']);
    Route::get('/all-pos-with-two-agents', ['as' => 'agent.all.pos.two.agents', 'uses' => 'AgentPosController@all_pos_with_two_agents']);
    Route::get('/all-pos-returns', ['as' => 'agent.all.pos.returns', 'uses' => 'AgentPosController@all_pos_returns']);
    Route::get('export-all-available-pos', [ 'uses' => 'AgentPosController@export_all_available_pos'])->name('all-available-pos-excel');
    Route::get('export-all-customer-pos', [ 'uses' => 'AgentPosController@export_all_customer_pos'])->name('all-customer-pos-excel');
    Route::get('export-all-two-agents-pos', [ 'uses' => 'AgentPosController@export_all_two_agents_pos'])->name('all-two-agents-pos-excel');
    Route::get('export-all-returns-pos', [ 'uses' => 'AgentPosController@export_all_returns_pos'])->name('all-returns-pos-excel');
    Route::get('export-all-customer-pos-pdf', 'AgentPosController@export_all_pos_customer_pdf')->name('all-customer-pos-pdf');
    Route::get('export-all-available-pos-pdf', 'AgentPosController@export_all_pos_available_pdf')->name('all-available-pos-pdf');
    Route::get('/show-customer/pos/{id}', ['as' => 'all.customer.pos.transactions.show', 'uses' => 'AgentPosController@show_pos_transactions']);
    
    Route::get('financialCustodays/{id}','FinancialCustodayController@index')->name('financialCustodays.index');
    Route::get('/PosStores', 'agentcontroller@agentsPosStored')->name('PosStores');
    Route::get('financialCustodays/export-all-transactions-pos/{id}', 'FinancialCustodayController@ExportExcel')->name('exportpdf.exportAllTransactionspos');

    Route::get('/agents-exportexcel', 'agentcontroller@AgentsExportExcel')->name('agents.exportexcel');

   Route::get('transfers-exportexcel','agentcontroller@transfersToBankExportExcel')->name('transfers.exportexcel');

   Route::get('/export-all-agent-customer-balances', [ 'uses' => 'agentcontroller@export_delegate_to_customer'])->name('agent-customer-balances-excel');
    Route::get('/export-all-customer-agent-balances', [ 'uses' => 'agentcontroller@export_customer_to_delegate'])->name('customer-agent-balances-excel');

    Route::get('financialCustodays/edit-pos-custoday/{id}', 'FinancialCustodayController@change_status');
    Route::get('agents-date-track/{date}', 'agentcontroller@track_agent_balance');
    Route::get('agents-date-track/agents-export-excel/{date}', 'agentcontroller@AgentsExportDateExcel')->name('agents.export-excel-date');
    Route::get('financialCustodays/edit-pos-custoday/{id}', 'FinancialCustodayController@change_status'); Route::get('financialCustodays/edit-pos-custoday/{id}', 'FinancialCustodayController@change_status');
    Route::post('edit-bank-transfer/{id}', 'agentcontroller@edit_bank_transfer');

    Route::post('pos-commissions', 'TransactionController@commission')->name('pos-commissions');
    Route::get('daily-commissions', 'TransactionController@commission_index')->name('daily-commissions');
    Route::get('export-daily-commissions', [ 'uses' => 'TransactionController@export_daily_commissions'])->name('all-customer-pos-excel');
    Route::get('export-daily-commissions-pdf', [ 'uses' => 'TransactionController@export_daily_commissions_pdf'])->name('all-customer-pos-pdf');
    Route::post('/refund-money-to-delegate/{pos_id}/{delegate_id}/{client_id}/{value}', [ 'uses' => 'agentcontroller@refund']);
  });











