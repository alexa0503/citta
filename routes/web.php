<?php

use Illuminate\Support\Facades\Route;
use App\Mallcoo;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;
use Illuminate\Http\Request;
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

Route::any('/', function (Request $request) {
    $languages = [
        'zh-CN' => "中",
        'zh-HK' => "繁",
        'en-US' => "Eng",
    ];
    $locale = in_array($request->input('lang'), array_keys($languages)) ? $request->input('lang') : 'zh-CN';
    App::setLocale($locale);
    $pages = [
        'home'=>[
            asset('images/pages/'.$locale.'/1.jpg'),
            asset('images/pages/'.$locale.'/2.jpg'),
            asset('images/pages/'.$locale.'/3.jpg'),
            asset('images/pages/'.$locale.'/4.jpg'),
            asset('images/pages/'.$locale.'/5.jpg'),
        ],
        'aboutcitta1'=>[
            asset('images/pages/'.$locale.'/7.jpg'),
            asset('images/pages/'.$locale.'/8.jpg'),
            asset('images/pages/'.$locale.'/9.jpg'),
            asset('images/pages/'.$locale.'/10.jpg'),
            asset('images/pages/'.$locale.'/11.jpg'),
            asset('images/pages/'.$locale.'/12.jpg'),
        ],
        'aboutcitta2'=>[
            asset('images/pages/'.$locale.'/13.jpg'),
            asset('images/pages/'.$locale.'/14.jpg'),
        ],
        'aboutkwah1'=>[
            asset('images/pages/'.$locale.'/15.jpg'),
            asset('images/pages/'.$locale.'/16.jpg'),
            asset('images/pages/'.$locale.'/17.jpg'),
        ],
        'aboutkwah2'=>[
            asset('images/pages/'.$locale.'/18.jpg'),
        ],
        'aboutkwah3'=>[
            asset('images/pages/'.$locale.'/19.jpg'),
        ],
        'aboutkwah4'=>[
            asset('images/pages/'.$locale.'/20.jpg'),
        ],
        'aboutkwah5'=>[
            asset('images/pages/'.$locale.'/21.jpg'),
        ],
        'contactus'=>[
            asset('images/pages/'.$locale.'/22.jpg'),
        ],
    ];
    return view('index', [
        'languages' => $languages,
        'pages' => $pages
    ]);
});
Route::group(['middleware' => ['auth']], function () {
    Route::any('/cms/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');
    Route::any('/cms/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');
});
