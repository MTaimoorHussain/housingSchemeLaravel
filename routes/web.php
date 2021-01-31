<?php

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
	return view('layouts.website.index');

});

Auth::routes();

Route::resource('dashboard', 'HomeController');

Route::resource('allbank', 'AllBankController');
Route::post('allbank/update', 'AllBankController@update')->name('allbank.update');
Route::get('allbank/edit/{id}', 'AllBankController@edit');
Route::get('allbank/destroy/{id}', 'AllBankController@destroy');

Route::resource('bankdetail','BankDetailController');
Route::post('bankdetail/update', 'BankDetailController@update')->name('bankdetail.update');
Route::get('bankdetail/edit/{id}', 'BankDetailController@edit');
Route::get('bankdetail/destroy/{id}', 'BankDetailController@destroy');

Route::resource('chargetype','ChargeTypeController');
Route::post('chargetype/update', 'ChargeTypeController@update')->name('chargetype.update');
Route::get('chargetype/edit/{id}', 'ChargeTypeController@edit');
Route::get('chargetype/destroy/{id}', 'ChargeTypeController@destroy');

Route::resource('plottype','PlotTypeController');
Route::post('plottype/update', 'PlotTypeController@update')->name('plottype.update');
Route::get('plottype/edit/{id}', 'PlotTypeController@edit');
Route::get('plottype/destroy/{id}', 'PlotTypeController@destroy');

Route::resource('tender','TenderController');
Route::post('tender/update', 'TenderController@update')->name('tender.update');
Route::get('tender/edit/{id}', 'TenderController@edit');
Route::get('tender/destroy/{id}', 'TenderController@destroy');

Route::resource('plotcategory','PlotCategoryController');
Route::post('plotcategory/update', 'PlotCategoryController@update')->name('plotcategory.update');
Route::get('plotcategory/edit/{id}', 'PlotCategoryController@edit');
Route::get('plotcategory/destroy/{id}', 'PlotCategoryController@destroy');

Route::resource('charge','ChargeController');
Route::post('charge/update', 'ChargeController@update')->name('charge.update');
Route::get('charge/edit/{id}', 'ChargeController@edit');
Route::get('charge/destroy/{id}', 'ChargeController@destroy');

Route::resource('block','BlockController');
Route::post('block/update', 'BlockController@update')->name('block.update');
Route::get('block/edit/{id}', 'BlockController@edit');
Route::get('block/destroy/{id}', 'BlockController@destroy');

Route::resource('societylayoutplan','SocietyLayoutController');
Route::post('societylayoutplan/update', 'SocietyLayoutController@update')->name('societylayoutplan.update');
Route::get('societylayoutplan/edit/{id}', 'SocietyLayoutController@edit');
Route::get('societylayoutplan/destroy/{id}', 'SocietyLayoutController@destroy');
