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

Route::get('/', 'DeckController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// decks
Route::resource('decks', 'DeckController');
Route::get('/decks/index/results', 'DeckController@results');


// cards
Route::get('/decks/{deck}/create', 'CardController@create');
Route::post('/decks/{deck}/card', 'CardController@store');
Route::delete('/cards/{card}', 'CardController@destroy');
Route::get('/cards/{card}', 'CardController@show');
Route::get('/cards/{card}/edit', 'CardController@edit');


# review mode
Route::get('/decks/{deck}/review', 'DeckController@review');


# study mode
Route::get('/decks/{deck}/study', 'StudyController@study');
//Route::get('/decks/{deck}/study/{card}', 'StudyController@result');
Route::get('/study/{deck}', 'StudyController@getCard');
