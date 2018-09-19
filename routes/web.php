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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');



Route::get('/people', 'EmployeeController@getPeople');
Route::get('/getDirects/{id}','EmployeeController@getDirects');


Route::get('/people/index','EmployeeController@index');


Route::post('/people','EmployeeController@store');
Route::get('/people/create','EmployeeController@create');

Route::get('/people/{id}/edit','EmployeeController@edit');
Route::post('/people/{id}/update','EmployeeController@update');
Route::post('/people/{id}','EmployeeController@destroy');
