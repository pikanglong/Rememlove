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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'ajax','namespace' => 'Ajax'], function () {
    Route::group(['prefix' => 'binding'], function () {
        Route::post('/newInviteCode', 'BindingController@newInviteCode')->middleware('auth')->name('binding_newInviteCode');
        Route::post('/confirmInvite', 'BindingController@confirmInvite')->middleware('auth')->name('binding_confirmInvite');
    });
});

Route::group(['prefix' => 'membox'], function () {
    Route::get('/', 'MemboxController@index')->name('membox_index');
    Route::get('/square', 'MemboxController@square')->name('membox_square');
    Route::get('/index', 'MemboxController@index')->name('membox_index');
    Route::get('/view', 'MemboxController@view')->name('membox_view');
    Route::get('/edit', 'MemboxController@edit')->name('membox_edit');
    Route::get('/create', 'MemboxController@create')->name('membox_create');
});

Route::group(['prefix' => 'checkin'], function () {
    Route::get('/', 'CheckinController@index')->name('checkin_index');
    Route::get('/index', 'CheckinController@index')->name('checkin_index');
});

Route::group(['prefix' => 'message'], function () {
    Route::get('/', 'MessageController@index')->name('message_index');
    Route::get('/index', 'MessageController@index')->name('message_index');
    Route::get('/view', 'MessageController@view')->name('message_view');
});

Route::group(['prefix' => 'binding'], function () {
    Route::get('/', 'BindingController@index')->name('binding_index');
    Route::get('/index', 'BindingController@index')->name('binding_index');
    Route::get('/invite/{invite_code}', 'BindingController@invite')->name('binding_invite');
});

Route::group(['prefix' => 'account'], function () {
    Route::get('/', 'AccountController@dashboard')->name('account_dashboard');
    Route::get('/dashboard', 'AccountController@dashboard')->name('account_dashboard');
    Route::get('/getqrcode', 'AccountController@getqrcode')->name('getqrcode');
});

Route::get('/about', function () {
    return view('about',[
        'page_title' => "关于",
        'site_title' => "记恋",
    ]);
});
Auth::routes();
