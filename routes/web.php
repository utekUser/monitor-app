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
    return view('welcome');
});

Route::get('/monitor', function () {
    return view('monitor');
});

Route::view('/companies', 'admin.companies.index');

Route::view('/home', 'home');

Route::resource('/getdata', 'GetDataController',['only' => ['index', 'store', 'show', 'destroy']]);


Auth::routes();

