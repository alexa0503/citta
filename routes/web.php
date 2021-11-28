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
            [
                'image' => asset('images/pages/1.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-1.png'),
                    'style'=>'left:19%;top:43%;width:30%;'
                ],
            ],
            [
                'image' => asset('images/pages/2.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-2.png'),
                    'style'=>'right:15%;top:25%;width:30%;'
                ],
            ],
            [
                'image' => asset('images/pages/3.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-3.png'),
                    'style'=>'left:19%;top:24.5%;width:30%;'
                ],
            ],
            [
                'image' => asset('images/pages/4.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-4.png'),
                    'style'=>'right:15%;top:24.5%;width:30%;'
                ],
            ],
            [
                'image' => asset('images/pages/5.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-5.png'),
                    'style'=>'right:14%;bottom:21.5%;width:30%;'
                ],
            ],
        ],
        'aboutcitta1'=>[
            [
                'image' => asset('images/pages/7.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-7.png'),
                    'style'=>'right:10%;bottom:0;width:38.92%;'
                ],
            ],
            [
                'image' => asset('images/pages/8.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-8.png'),
                    'style'=>'left:20%;bottom:12.5%;width:22.51%;'
                ],
            ],
            [
                'image' => asset('images/pages/9.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-9.png'),
                    'style'=>'left:15%;top:36.5%;width:15.01%;'
                ],
            ],
            [
                'image' => asset('images/pages/10.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-10.png'),
                    'style'=>'right:6%;bottom:16.5%;width:15.01%;'
                ],
            ],
            [
                'image' => asset('images/pages/11.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-11.png'),
                    'style'=>'left:16%;top:33.5%;width:20.01%;'
                ],
            ],
            [
                'image' => asset('images/pages/12.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-12.png'),
                    'style'=>'left:10%;bottom:23.5%;width:20.01%;'
                ],
            ],
        ],
        'aboutcitta2'=>[
            [
                'image' => asset('images/pages/13.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-13.png'),
                    'style'=>'left:14%;bottom:0%;width:30.24%;'
                ],
            ],
            
            [
                'image' => asset('images/pages/14.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-14.png'),
                    'style'=>'left:14%;bottom:0%;width:30.24%;'
                ],
            ],
        ],
        'aboutkwah1'=>[
            [
                'image' => asset('images/pages/15.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-15.png'),
                    'style'=>'left:18%;bottom:15%;width:25.88%;'
                ],
            ],   
            [
                'image' => asset('images/pages/16.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-16.png'),
                    'style'=>'left:18%;top:20%;width:25.88%;'
                ],
            ],
            [
                'image' => asset('images/pages/17.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-17.png'),
                    'style'=>'left:30%;top:30%;width:25.88%;'
                ],
            ],
        ],
        'aboutkwah2'=>[
            [
                'image' => asset('images/pages/18.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-18.png'),
                    'style'=>'left:33.33%;bottom:0;width:25.88%;'
                ],
            ],
        ],
        'aboutkwah3'=>[
            [
                'image' => asset('images/pages/19.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-19.png'),
                    'style'=>'left:14%;bottom:0;width:30.22%;'
                ],
            ],
        ],
        'aboutkwah4'=>[
            [
                'image' => asset('images/pages/20.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-20.png'),
                    'style'=>'left:12%;top:24%;width:13.70%;'
                ],
            ],
        ],
        'aboutkwah5'=>[
            [
                'image' => asset('images/pages/21.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-21.png'),
                    'style'=>'left:0;bottom:0;width:100%;'
                ],
            ],
        ],
        'contactus'=>[
            [
                'image' => asset('images/pages/22.jpg'),
                'title' => [
                    'image'=>asset('images/'.$locale.'/title-22.png'),
                    'style'=>'left:14%;top:30%;width:14.355%;'
                ],
                'footer' => [
                    'image'=>asset('images/'.$locale.'/footer-22.png'),
                    'style'=>'left:0;bottom:0;width:100%;'
                ],
            ],
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
