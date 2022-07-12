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
    return view('guests.welcome');
})->name('home');

Auth::routes();

Route::middleware('auth')
    ->name('admin.')
    ->namespace('admin')
    ->prefix('admin')
    ->group(function(){
        Route::get('/', 'PageController@index')->name('index');
        Route::resource('pizzas', 'PizzaController');
        Route::resource('ingredients', 'IngredientController');
    });
