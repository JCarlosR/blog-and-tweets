<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entries/create', 'EntryController@create');
Route::post('/entries', 'EntryController@store');

Route::get('/entries/{entry}', 'GuestController@show');

Route::get('/entries/{entry}/edit', 'EntryController@edit');
Route::put('/entries/{entry}', 'EntryController@update');

Route::get('/users/{user}', 'UserController@show');
