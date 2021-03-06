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

Route::get('/', 'HomeController@index')->name('home2');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/share/{sharelink}', 'ShareController@view')->name('share');

Route::group(['prefix' => 'ajax','namespace' => 'Ajax','middleware' => 'auth'], function () {
    Route::group(['prefix' => 'binding'], function () {
        Route::post('/newInviteCode', 'BindingController@newInviteCode')->name('binding_newInviteCode');
        Route::post('/confirmInvite', 'BindingController@confirmInvite')->name('binding_confirmInvite');
        Route::post('/queryCode', 'BindingController@queryCode')->name('binding_queryCode');
        Route::post('/searchUser', 'BindingController@searchUser')->name('binding_searchUser');
        Route::post('/sendInvite', 'BindingController@sendInvite')->name('binding_sendInvite');
    });
    Route::group(['prefix' => 'checkin'], function () {
        Route::post('/newTask/{mode}', 'CheckinController@newTask')->name('check_newTask');
        Route::post('/submit', 'CheckinController@submit')->name('check_submit');
    });
    Route::group(['prefix' => 'message'], function () {
        Route::post('/read', 'MessageController@read')->name('message_read');
    });
    Route::group(['prefix' => 'account'], function () {
        Route::post('/updateavatar', 'AccountController@updateAvatar')->name('account_updateAvatar');
    });
    Route::group(['prefix' => 'membox'], function () {
        Route::post('/new', 'MemboxController@newpost')->name('membox_new');
        Route::post('/share', 'MemboxController@share')->name('share_post');
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

Route::group(['prefix' => 'checkin','middleware' => 'auth'], function () {
    Route::get('/', 'CheckinController@index')->name('checkin_index');
    Route::get('/index', 'CheckinController@index')->name('checkin_index');
});

Route::group(['prefix' => 'message','middleware' => 'auth'], function () {
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
