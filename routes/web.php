<?php

use App\Http\Controllers\MyBackUpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::middleware(['auth'])->group(function () {
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

Route::get('get_piecejointe/{id}','CourrierController@get_pieces_jointe');

Route::delete('set_piecejointe','CourrierController@set_pieces_jointe');

Route::delete('piecejointes/{id}', 'PiecejointeController@destroy')->name('piecejointes.destroy');

Route::POST('piecejointe', 'PiecejointeController@store')->name('piecejointe.store');

Route::POST('users/import','UserController@import')->name('users.import');


Route::get('courrier/{id}/redirect','RedirectController@index')->name('courrier.redirect');

Route::get('courrier/{id}/redirect/sous_services','RedirectController@get_sous_service');

Route::post('courrier/{id}/redirect/sous_services/redirect','RedirectController@redirect')->name('courrier.redirect.go');


  
Route::get('backups', 'MyBackUpController@index')->name('backups.list');

Route::get('backups/nouveau', 'MyBackUpController@nouveau_backup')->name('backup.nouveau');
    

Route::get('telecharger/{file}', 'MyBackUpController@telecharger')->name('backup.telecharger');

Route::get('supprimer/{file}', 'MyBackUpController@supprimer')->name('backup.supprimer');
});



