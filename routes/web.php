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
    return view('welcome',[
        'page_title' => "欢迎",
        'site_title' => "记恋",
        'navigation' => "Home",
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/account', 'HomeController@account')->name('account');
