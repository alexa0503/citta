<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\UserJoined;
use App\Events\GiftSent;
use App\Http\Resources\UserGfitResource;
use App\Http\Resources\UserResource;
use App\Models\UserGift;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
# 小程序接口，需认证
Route::namespace('App\Http\Controllers\Api')->prefix('v1')->middleware(['auth:api', 'throttle:600000'])->group(function () {
    Route::any('logout', 'AuthController@logout');
    Route::any('refresh', 'AuthController@refresh');
    Route::any('me', 'AuthController@me')->name('me');
    Route::any('join', function () {
        $user = auth('api')->user();
        DB::table('users')->where('id', $user->id)->update(['joined_at' => Carbon::now()]);
        $teams = [
            'points' => [100, 200],
            'user' => new UserResource($user),
        ];
        event(new UserJoined($teams));
        // broadcast(new UserJoined($user))->toOthers();
        return response()->json(['code' => 0, 'message' => '']);
    });
    Route::any('gift/{gift}', function (Request $request, $gift) {
        $user = auth('api')->user();
        //礼物：心（1），喇叭车（50），鸟笼车（50）
        //一分钟之内
        DB::beginTransaction();
        try {
            $time = Carbon::now()->subMinute(1);
            switch ($gift) {
                case '1':
                    $count = UserGift::where('user_id', $user->id)->where('name', $gift)->where('created_at', '>=', $time)->count();
                    if ($count >= 60) {
                        $return = ['code' => 1001, 'message' => '点太快啦，请休息会~'];
                    }
                    break;
                case '2':
                    $count = UserGift::where('user_id', $user->id)->where('name', $gift)->count();
                    if ($count >= 3) {
                        $return = ['code' => 1002, 'message' => '喇叭车只能送2次哦~'];
                    }
                    break;
                case '3':
                    $count = UserGift::where('user_id', $user->id)->where('name', $gift)->count();
                    if ($count >= 2) {
                        $return = ['code' => 1003, 'message' => '鸟笼车只能送三次哦~'];
                    }
                    break;
                default:
                    # code...
                    $return = ['code' => 0, 'message' => ''];
                    break;
            }
            $points_settings = [
                1 => 1,
                2 => 50,
                3 => 50,
            ];
            $user_gift = new UserGift();
            $user_gift->user_id = $user->id;
            $user_gift->name = $gift;
            $user_gift->points = $points_settings[$gift];
            $user_gift->save();
            $teams = [
                'points' => [100, 200],
                'user' => new UserResource($user),
                'gift' => new UserGfitResource($user_gift),
            ];
            DB::commit();
            $return = ['code' => 0, 'message' => ''];
            event(new GiftSent($teams));
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            $return = ['code' => 1001, 'message' => $th->getMessage()];
        }
        return response()->json($return);;
    })->where('gift', '[1-3]');
    //领券
    Route::any('receive', function (Request $request) {
    });
    // Route::post('update', 'AuthController@update');
    // Route::post('mobile/update', 'AuthController@updateMobile');
});
# 小程序接口，无需认证
Route::namespace('App\Http\Controllers\Api')->prefix('v1')->middleware(['throttle:600000'])->group(function () {
    Route::any('login', 'AuthController@login');
});
