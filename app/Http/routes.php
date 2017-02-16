<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/tickets', 'Admin\TicketController@index');
Route::get('/tickets/create', 'Admin\TicketController@create');
Route::get('/tickets/edit/{id}', 'Admin\TicketController@edit');
Route::post('/tickets/destroy/{id}', 'Admin\TicketController@destroy');
Route::post('/tickets/store', 'Admin\TicketController@store');
Route::post('/tickets/update/{id}', 'Admin\TicketController@update');

Route::get('/customers', 'Admin\CustomerController@index');
Route::get('/customers/create', 'Admin\CustomerController@create');
Route::get('/customers/edit/{id}', 'Admin\CustomerController@edit');
Route::post('/customers/update/{id}', 'Admin\CustomerController@update');
Route::post('/customers/destroy/{id}', 'Admin\CustomerController@destroy');
Route::post('/customers/store', 'Admin\CustomerController@store');


Route::post('/actions/store', 'Admin\ActionController@store');
Route::get('/actions/edit/{id}', 'Admin\ActionController@edit');
Route::post('/actions/edit/{id}', 'Admin\ActionController@update');
Route::post('/actions/destroy/{id}', 'Admin\ActionController@destroy');


Route::post('/hardware/store', 'Admin\HardwareController@store');
Route::get('/hardware/edit/{id}', 'Admin\HardwareController@edit');
Route::post('/hardware/edit/{id}', 'Admin\HardwareController@update');

