<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\UserJoined;
use App\Events\GiftSent;
use App\Events\TeamsFetched;
use App\Http\Resources\UserGfitResource;
use App\Http\Resources\UserResource;
use App\Models\UserGift;
use App\Mallcoo;
use Illuminate\Support\Facades\Log;
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
    Route::any('callback', function (Request $request) {
        $ticket = $request->input('ticket');
        // $DataSource  = $request->input('DataSource');
        $user = auth('api')->user();
        $mallcoo = new Mallcoo();
        $mallcoo_user = $mallcoo->fetchUser($ticket);
        if ($mallcoo_user) {
            //发券
            if ($user->mallcoo_has_received == 0) {
                $mallcoo = new Mallcoo();
                $send_coupon_response[0] = $mallcoo->sendCoupon($user, '1');
                $send_coupon_response[1] = $mallcoo->sendCoupon($user, '2');
                $send_coupon_response[2] = $mallcoo->sendCoupon($user, '3');
                // $send_coupon_response = $mallcoo->sendCoupon($user);
                $mallcoo_has_received = 1;
                $arr = [];
                foreach ($send_coupon_response as $v) {
                    if ($v === null) {
                        $mallcoo_has_received = 0;
                    } else {
                        $arr[] = $v['TraceID'];
                    }
                }
                // $mallcoo_has_received = $send_coupon_response === null ? 0 : 1;
                $mallcoo_trace_id = implode(',', $arr);
                Log::channel('coupons')->info($user->id.','.json_encode($send_coupon_response));
            } else {
                $mallcoo_has_received = 1;
                $mallcoo_trace_id = $user->mallcoo_trace_id;
            }

            DB::table('users')->where('id', $user->id)->update([
                'mallcoo_avatar' => $mallcoo_user['Avatar'],
                'mallcoo_id' => $mallcoo_user['OpenUserId'],
                'mallcoo_nickname' => $mallcoo_user['NickName'],
                'mallcoo_mobile' => $mallcoo_user['Mobile'],
                'mallcoo_has_received' => $mallcoo_has_received,
                'mallcoo_trace_id' => $mallcoo_trace_id,
            ]);
            //拉去用户积分
            // $mallcoo_user_points = $mallcoo->fetcUserPoints($mallcoo_user['OpenUserId']);

            // foreach ($mallcoo_user_points as $row) {
            //     $time1 = Carbon::parse($row['ScoreTime']);
            //     $time2 = Carbon::parse('2021-10-01');
            //     if ($time1->gt($time2)  && !UserGift::where('mallcoo_record_id', $row['ScoreRecordID'])->where('name', 10)->first()) {
            //         $user_gift = new UserGift();
            //         $user_gift->mallcoo_record_id = $row['ScoreRecordID'];
            //         $user_gift->name = 10; //积分消费
            //         $user_gift->user_id = $user->id;
            //         $user_gift->points = $row['Score'];
            //         $user_gift->save();

            //         $teams = [
            //             'user' => new UserResource($user),
            //             'gift' => new UserGfitResource($user_gift),
            //         ];
            //         event(new GiftSent(App\Helper::teams($teams)));
            //     }
            // }
            return response()->json(['code' => 0, 'message' => '']);
        } else {
            return response()->json(['code' => 1100, 'message' => '为获取到用户信息']);
        }
    });
    Route::any('join/{team}', function (Request $request, $team) {
        $user = auth('api')->user();
        if ($user->team !== null) {
            return response()->json(['code' => 1001, 'message' => '已经选过战队了']);
        }
        DB::table('users')->where('id', $user->id)->update(['joined_at' => Carbon::now(), 'team' => $team]);

        if (Cache::has('team' . $team . '_amount') && !env('POINTS_SHOWN')) {
            Cache::increment('team' . $team . '_amount', 1);
        }
        $user = App\Models\User::find($user->id);
        $teams = [
            'user' => new UserResource($user),
        ];
        event(new UserJoined(App\Helper::teams($teams)));
        return response()->json(['code' => 0, 'message' => '']);
    })->where('team', '[1-2]');
    Route::any('gift/{gift}', function (Request $request, $gift) {
        $user = auth('api')->user();
        if (!$user->team) {
            return response()->json(['code' => 1100, 'message' => '您还没有参加战队']);;
        }
        //礼物：心（1），喇叭车（50），鸟笼车（50）
        //一分钟之内
        $return = ['code' => 0, 'message' => ''];
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
                    if ($count >= env('MAX_GIFT_NUMBER_2', 3)) {
                        $return = ['code' => 1002, 'message' => '喇叭车只能送3次哦~'];
                    }
                    break;
                case '3':
                    $count = UserGift::where('user_id', $user->id)->where('name', $gift)->count();
                    if ($count >= env('MAX_GIFT_NUMBER_3', 2)) {
                        $return = ['code' => 1003, 'message' => '鸟笼车只能送2次哦~'];
                    }
                    break;
                default:
                    # code...
                    // $return = ['code' => 0, 'message' => ''];
                    break;
            }
            if ($return['code'] === 0) {
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
                DB::table('users')->where('id', $user->id)->increment('points', $points_settings[$gift]);
                $team = $user->team;
                if (Cache::has('team' . $team . '_amount') && env('POINTS_SHOWN')) {
                    Cache::increment('team' . $team . '_amount', $points_settings[$gift]);
                }
                $teams = [
                    'user' => new UserResource($user),
                    'gift' => new UserGfitResource($user_gift),
                ];
                event(new GiftSent(App\Helper::teams($teams)));
            }
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            $return = ['code' => 1001, 'message' => $th->getMessage()];
        }
        return response()->json($return);;
    })->where('gift', '[1-3]');
});
# 小程序接口，无需认证
Route::namespace('App\Http\Controllers\Api')->prefix('v1')->middleware(['throttle:600000'])->group(function () {
    Route::any('login', 'AuthController@login');
});
