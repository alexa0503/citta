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
Route::any('/',function(){
    // abort(404);
    return view('welcome');
});
Route::middleware(['auth:api', 'throttle:600000'])->group(function () {
    Route::any('callback', function (Request $request) {
        $ticket = $request->input('Ticket');
        // $DataSource  = $request->input('DataSource');
        $user = auth('api')->user();
        $mallcoo = new Mallcoo();
        $mallcoo_user = $mallcoo->getUser($ticket);
        DB::table('users')->update([
            'mallcoo_id' => $mallcoo_user->OpenUserID,
            'mallcoo_avatar' => $mallcoo_user->Avatar,
            'mallcoo_nickname' => $mallcoo_user->NickName,
        ])->where('id', $user->id);
        $url = session('oauth_redirect_uri') ?? url('/');
        return redirect($url);
    });
});

Route::any('oauth', function (Request $request) {
    $url = $request->input('url');
    session(['oauth_redirect_uri' => urldecode($url)]);
    $mallcoo = new Mallcoo();
    $url = $mallcoo->getAuthRedirectUri();
    return redirect($url);
});