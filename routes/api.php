<?php

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

Route::apiResource('subscribers', 'API\SubscriberController');
Route::apiResource('fields', 'API\FieldController');
Route::get('fields/{field}/subscribers', 'API\FieldSubscriberController@index')->name('fields.subscribers.index');
