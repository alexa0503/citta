<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
use App\Mallcoo;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserGfitResource;
use App\Http\Resources\UserResource;
use App\Events\UserJoined;
use App\Events\GiftSent;
use App\Models\UserGift;
use App\Models\User;
use Carbon\Carbon;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');
Artisan::command('coupons:send', function () {
    $users = App\Models\User::where('mallcoo_has_received', 0)->whereNotNull('mallcoo_id')->get();
    foreach ($users as $user) {
        $mallcoo = new Mallcoo();
        $send_coupon_response[0] = $mallcoo->sendCoupon($user, '1');
        $send_coupon_response[1] = $mallcoo->sendCoupon($user, '2');
        $send_coupon_response[2] = $mallcoo->sendCoupon($user, '3');
        $mallcoo_has_received = 1;
        // var_dump(serialize($send_coupon_response));
        $arr = [];
        foreach ($send_coupon_response as $v) {
            if ($v && isset($v['Code']) && ($v['Code'] == 0 || $v['Code'] == 638)) {
                $arr[] = $v['TraceID'];
            } else {
                $mallcoo_has_received = 0;
            }
        }
        // $mallcoo_has_received = $send_coupon_response === null ? 0 : 1;
        $mallcoo_trace_id = implode(',', $arr);
        DB::table('users')->where('id', $user->id)->update([
            'mallcoo_has_received' => $mallcoo_has_received,
            'mallcoo_trace_id' => $mallcoo_trace_id,
        ]);
        Log::channel('console')->info($user->id . ',' . json_encode($send_coupon_response));
    }
});
//随机数据生成
Artisan::command('data:generate', function () {
    //生成用户并加入战队
    DB::beginTransaction();
    try {
        //code...
        $team_id = rand(1, 2);
        $user = new User();
        $user->mallcoo_mobile = '13' . rand(1, 9) . 'xxxx' . str_pad(rand(0, 9999), 4, "0", STR_PAD_LEFT);
        $user->openid = Str::random('40');
        $user->is_faker = 1;
        $user->team = $team_id;
        $user->points = 0;
        $user->joined_at = Carbon::now();
        $user->save();
        $teams = [
            'user' => new UserResource($user),
        ];

        if (Cache::has('team' . $team_id . '_amount') && !env('POINTS_SHOWN')) {
            Cache::increment('team' . $team_id . '_amount', 1);
        }
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollback();
        throw $th;
    }
    event(new UserJoined(App\Helper::teams($teams)));
    $points = rand(1000, 6000);
    $user_gift = new UserGift();
    $user_gift->user_id = $user->id;
    $user_gift->name = 10;
    $user_gift->points = $points;
    $user_gift->save();
    DB::table('users')->where('id', $user->id)->increment('points', $points);
    $team = $user->team;
    if (Cache::has('team' . $team . '_amount') && env('POINTS_SHOWN')) {
        Cache::increment('team' . $team . '_amount', $points);
    }
    $user = User::find($user->id);
    $teams = [
        'user' => new UserResource($user),
        'gift' => new UserGfitResource($user_gift),
    ];
    event(new GiftSent(App\Helper::teams($teams)));
});
//用户消费积分
Artisan::command('points:update', function () {
    if (!env('POINTS_SHOWN')) {
        return;
    }
    $users = User::whereNotNull('mallcoo_id ')->all();
    $mallcoo = new Mallcoo();
    foreach ($users as $user) {
        $mallcoo_user_points = $mallcoo->fetcUserPoints($user->mallcoo_id);
        foreach ($mallcoo_user_points as $row) {
            $time1 = Carbon::parse($row['ScoreTime']);
            $time2 = Carbon::parse(date('Y-m-d'));
            if ($time1->gt($time2)  && !UserGift::where('mallcoo_record_id', $row['ScoreRecordID'])->where('name', 10)->first()) {
                $user_gift = new UserGift();
                $user_gift->mallcoo_record_id = $row['ScoreRecordID'];
                $user_gift->name = 10; //积分消费
                $user_gift->user_id = $user->id;
                $user_gift->points = $row['Score'];
                $user_gift->save();

                $teams = [
                    'user' => new UserResource($user),
                    'gift' => new UserGfitResource($user_gift),
                ];
                event(new GiftSent(App\Helper::teams($teams)));
            }
        }
    }
});
