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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('service', 'ServiceController');
    
Route::resource('users', 'UserController');

Route::resource('courrier', 'CourrierController');

Route::resource('typecourrier', 'TypecourrierController');

Route::resource('mention', 'MentionController');

Route::resource('classement', 'ClassementController');

Route::get('/datatable', 'ClassementController@datatable');

Route::get('api/typecourrier/','TypeserviceController@getTypes')->name('type.getTypes');

Route::post('service/add_element/{id}' , 'ServiceController@setElements');
