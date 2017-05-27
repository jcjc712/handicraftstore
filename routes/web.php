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
    //return view('welcome');
    $usersWithPayments = \App\User::has('payments');
    return $usersWithPayments->skip(rand(0, $usersWithPayments->count()-1))->take(1)->get()[0]->id;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
