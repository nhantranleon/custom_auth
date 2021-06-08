<?php

use App\Http\Middleware\EmployeeAuthenticate;
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

Route::get('register', 'Auth\RegisterController@register');
Route::post('register', 'Auth\RegisterController@storeUser')->name('register');

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('login', 'Auth\LoginController@authenticate');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('home', 'Auth\LoginController@home')->name('home');

Route::get('forget-password', 'Auth\ForgotPasswordController@getEmail');
Route::post('forget-password', 'Auth\ForgotPasswordController@postEmail');

Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getPassword');
Route::post('reset-password', 'Auth\ResetPasswordController@updatePassword');



Route::group(['middleware' => ['auth'], 'prefix' => 'post/'],function ()
{
    Route::get('/', 'PostController@index')->name('post');
    Route::get('/edit/{id}', 'PostController@edit')->name('post.edit');
    Route::post('/edit/{id}', 'PostController@update')->name('post.update');
    Route::get('/create', 'PostController@create')->name('post.create');
    Route::post('/create', 'PostController@store')->name('post.store');
    Route::get('/filter', 'PostController@filter')->name('post.filter');
    Route::get('/autosearch', 'PostController@autoSearch')->name('post.autosearch');
    Route::post('/{id}', 'PostController@destroy')->name('post.delete');
    Route::get('/exportCsv', 'PostController@exportCsv')->name('post.export');
});
