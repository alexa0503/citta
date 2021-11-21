<?php

namespace App;

// use App\Http\Resources\UserGfitResource;
// use App\Http\Resources\UserResource;

use App\Models\Setting;
use App\Models\User;
use App\Models\Winner;
use DB;
use Cache;

class Helper
{
    //战队信息
    public static function teams($arr = [])
    {
        if (env('POINTS_SHOWN')) {
            $team1 = Cache::remember('team1_amount', 60, function () {
                return DB::table('users')->where('team', 1)->sum('points');
            });

            $team2 = Cache::remember('team2_amount', 60, function () {
                return DB::table('users')->where('team', 2)->sum('points');
            });
        } else {
            $team1 = Cache::remember('team1_amount', 60, function () {
                return 6000 + DB::table('users')->where('team', 1)->count();
            });

            $team2 = Cache::remember('team2_amount', 60, function () {
                return 6200 + DB::table('users')->where('team', 2)->count();
            });
        }

        // $team1_points = User::where('team', 1)->sum('points');
        // $team2_points = User::where('team', 2)->sum('points');
        $setting = Setting::find(1);
        $winners = Winner::all()->map(function ($item){
            return [
                'avatar'=>asset($item->avatar),
                'mobile'=>$item->mobile,
                'nickname'=>$item->nickname,
            ];
        });
        $teams = [
            'joinedNumber' => [$team1, $team2],
            'closed'=>env('HAS_CLOSED'),
            'winners' => [
                'shown' => $setting->body['shown'] ?? false,
                'data' => $winners
            ],
        ];
        return array_merge($teams, $arr);
    }
}
