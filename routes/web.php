<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// User profile
Route::get('/@{user}', 'UserController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entries/create', 'EntryController@create');
Route::post('/entries', 'EntryController@store');

// ->middleware('can:update,entry')
Route::get('/entries/{entry}/edit', 'EntryController@edit');
Route::put('/entries/{entry}', 'EntryController@update');


// Twitter
Route::get('/twitter/login', 'TwitterController@login')->name('twitter.login');
Route::get('/twitter/callback', 'TwitterController@callback')->name('twitter.callback');
Route::get('/twitter/error', 'TwitterController@error')->name('twitter.error');
Route::get('/twitter/logout', 'TwitterController@logout')->name('twitter.logout');
// Tweets
Route::get('/tweets', 'TweetController@update');


// Public routes
Route::get('/', 'GuestController@index');
Route::get('/entries/{entryBySlug}', 'GuestController@show');
