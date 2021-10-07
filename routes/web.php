<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user-login', 'HomeController@userLogin');

Route::get('/', 'AppController@index')->middleware('auth');

Route::get('/messages', 'MessageController@index')->middleware('auth');

Route::post('/messages', 'MessageController@store')->middleware('auth');

Route::post('/reactions', 'ReactionController@react')->middleware('auth');

// Route::get('/{any}', 'AppController@index')->where('any', '.*')->middleware('auth'); // catch all routes or else it will return 404 with Vue router in history mode

Route::post('/update/{id}', 'HomeController@update')->name('update')->middleware('auth');

Route::post('/updateAvatar/{id}', 'HomeController@updateAvatar')->name('updateAvatar')->middleware('auth');

Route::post('/add-room', 'RoomController@add')->middleware('auth');

Route::get('get-rooms', 'RoomController@index')->middleware('auth');

Route::get('edit-room/{id}', 'RoomController@show')->middleware('auth');

Route::post('edit-room/{id}', 'RoomController@update')->middleware('auth');

Route::post('delete-room', 'RoomController@delete')->middleware('auth');

