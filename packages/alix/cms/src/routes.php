<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//['auth:cms', 'menu']
Route::group(['middleware' => ['web', 'cms_auth:alix-cms'], 'prefix' => 'cms', 'namespace' => 'Alix\Cms\Http\Controllers', 'as' => 'cms.'], function () {
    Route::get('/', function () {
        return redirect(route('cms.dashboard'));
    });
    Route::get('account', 'IndexController@account')->name('account');
    // Route::get('profile', 'Admin\IndexController@profile')->name('cms::partialsprofile');
    // Route::put('password', 'Admin\IndexController@resetPassword')->name('cms::partialspassword.reset');
    Route::get('/dashboard', 'IndexController@index')->name('dashboard');

    // Route::get('/users/{userid}/download', 'Admin\UserController@download')->name('users.download');
    Route::resource('users', 'UserController');
    Route::resource('settings', 'SettingController');
    Route::resource('posts', 'PostController');
    Route::resource('appointments', 'AppointmentController');

    Route::get('upload', 'IndexController@upload')->name('upload');
    //
    Route::get('logout', 'LoginController@logout')->name('logout');
});
Route::group(['middleware' => ['web'], 'prefix' => 'cms', 'namespace' => 'Alix\Cms\Http\Controllers', 'as' => 'cms.'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
});

Route::group(['middleware' => ['web', 'cms_auth:alix-cms'], 'prefix' => 'cms', 'namespace' => 'Alix\Cms\Http\Controllers'], function () {
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');
    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');
});
