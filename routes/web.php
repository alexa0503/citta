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

Route::any('/', function () {
    // abort(404);
    return view('welcome');
});
Route::any('login', function () {
    if (!auth('api')->user()) {
        return response()->json(['code' => 2001, 'message' => '无用户信息'], 422);
    }
    abort(403);
})->name('login');
Route::any('coupons', function (Request $request) {
    abort(404);
    $mallcoo = new App\Mallcoo;
    // $coupons = $mallcoo->fetchCoupons();
    $user = App\Models\User::where('id', $request->input('id')??1)->first();
    $res = $mallcoo->sendCoupon($user,1);
    dd($res);
});
Route::get('jssdk', function (Request $request) {
    $url = urldecode($request->input('url') ?? url('/'));
    $app = app('wechat.official_account');
    // $officialAccount = EasyWeChat::officialAccount(); // 公众号
    $app->jssdk->setUrl($url);
    return $app->jssdk->buildConfig(['onMenuShareTimeline','onMenuShareAppMessage'],false);
});
// WebSocketsRouter::webSocket('/teams', App\TeamsWebSocketHandler::class);// MyCustomWebSocketHandler
// Route::middleware(['auth:api', 'throttle:600000'])->group(function () {
//     Route::any('callback', function (Request $request) {
//         $ticket = $request->input('Ticket');
//         // $DataSource  = $request->input('DataSource');
//         $user = auth('api')->user();
//         $mallcoo = new Mallcoo();
//         $mallcoo_user = $mallcoo->fetchUser($ticket);
//         if ($mallcoo_user) {
//             DB::table('users')->where('id', $user->id)->update([
//                 'mallcoo_avatar' => $mallcoo_user['Avatar'],
//                 'mallcoo_id' => $mallcoo_user['OpenUserId'],
//                 'mallcoo_nickname' => $mallcoo_user['NickName'],
//             ]);
//             //拉去用户积分
//             $url = session('oauth_redirect_uri') ?? url('/');
//             return redirect($url);
//         } else {
//             abort(404);
//         }
//     });
// });
// Route::any('login', function () {
//     abort(403);
// })->name('login');

// Route::any('oauth', function (Request $request) {
//     $url = $request->input('url');
//     $token = $request->input('token');
//     session(['oauth_redirect_uri' => urldecode($url)]);
//     $mallcoo = new Mallcoo();
//     $url = $mallcoo->oAuthRedirectUri($token);
//     return redirect($url);
// });