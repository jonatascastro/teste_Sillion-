<?php

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

#login  pagina inicial após login
Route::prefix("home")->controller('App\Http\Controllers\HomeController')->group(function () {
     Route::get('', 'index');
     Route::post('listar', 'listar')->name("home.listar");//datatable dados
     Route::get('{id}/edit', 'edit')->name("home.edit");//datatable dados
     Route::get('{id}/delete', 'delete')->name("home.delete");//datatable dados
     Route::post('update','update')->name("home.update");//datatable dados
     Route::get('create','create')->name('home.create');
     Route::post('store','store')->name('store');

});


