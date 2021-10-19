<?php

namespace App;

// use App\Http\Resources\UserGfitResource;
// use App\Http\Resources\UserResource;
use App\Models\User;
use DB;
use Cache;

class Helper
{
    //战队信息
    public static function teams($arr = [])
    {
        if (env('POINTS_SHOWN')) {
            $team1 = Cache::remember('team1_amount',60, function () {
                return DB::table('users')->where('team', 1)->sum('points');
            });

            $team2 = Cache::remember('team2_amount',60, function () {
                return DB::table('users')->where('team', 2)->sum('points');
            });
        } else {
            $team1 = Cache::remember('team1_amount',60, function () {
                return 6000 + DB::table('users')->where('team', 1)->count();
            });

            $team2 = Cache::remember('team2_amount',60, function () {
                return 6200 + DB::table('users')->where('team', 2)->count();
            });
        }

        // $team1_points = User::where('team', 1)->sum('points');
        // $team2_points = User::where('team', 2)->sum('points');
        $teams = [
            'joinedNumber' => [$team1, $team2],
            'winners' => [
                'shown' => false,
                'data' => [
                    ['avatar' => 'http://thirdwx.qlogo.cn/mmopen/8iaVwlLVvSzSMMf7NT6JGMbRBRicf9lPpPcYnLj5ADkibibAJIxQicvMk2K40LFWKvzwQ7qqMCpNjNSE7Wa7Tq5JQ2yebUdwQgoZK/132', 'mobile' => '13816131120','nickname'=>'Tony凹凸曼⁶⁶⁶'],
                    ['avatar' => 'http://thirdwx.qlogo.cn/mmopen/8iaVwlLVvSzSMMf7NT6JGMbRBRicf9lPpPcYnLj5ADkibibAJIxQicvMk2K40LFWKvzwQ7qqMCpNjNSE7Wa7Tq5JQ2yebUdwQgoZK/132', 'mobile' => '13816131120','nickname'=>'Tony凹凸曼⁶⁶⁶'],
                    ['avatar' => 'http://thirdwx.qlogo.cn/mmopen/8iaVwlLVvSzSMMf7NT6JGMbRBRicf9lPpPcYnLj5ADkibibAJIxQicvMk2K40LFWKvzwQ7qqMCpNjNSE7Wa7Tq5JQ2yebUdwQgoZK/132', 'mobile' => '13816131120','nickname'=>'Tony凹凸曼⁶⁶⁶']
                ]
            ],
        ];
        return array_merge($teams, $arr);
    }
}
