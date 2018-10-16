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


//Employees table
Route::get('/people', 'EmployeeController@getPeople');
Route::get('/getDirects/{id}','EmployeeController@getDirects');
Route::get('/people/index','EmployeeController@index');
Route::post('/people','EmployeeController@store');
Route::get('/people/create','EmployeeController@create');
Route::get('/people/{id}/edit','EmployeeController@edit');
Route::post('/people/{id}/update','EmployeeController@update');
Route::post('/people/{id}','EmployeeController@destroy');
Route::post('/userid/{id}','EmployeeController@user_id');


//Users table
Route::get('/people/edit_mount','EmployeeController@edit_mount'); //Auth User
Route::post('people/editUser','UserController@update');
Route::post('/user','UserController@store');
Route::get('/users', 'UserController@getUsers');
Route::get('/indexUsers', 'UserController@index');


//permissions table
Route::get('/permission', 'PermissionController@getPermission');

//Sites table
Route::get('/sites/index','SiteController@index');
Route::get('/sites', 'SiteController@getSites');
Route::post('/sites','SiteController@store');
Route::get('/sites/create','SiteController@create');
Route::get('/mysite','SiteController@mysite');



//RouteGroupe  /people csoportok
