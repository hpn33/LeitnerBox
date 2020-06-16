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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('decks', 'DeckController');

// cards
Route::get('/decks/{deck}/create', 'CardController@create');
Route::post('/decks/{deck}/card', 'CardController@store');
Route::delete('/cards/{card}', 'CardController@destroy');
Route::get('/cards/{card}', 'CardController@show');
