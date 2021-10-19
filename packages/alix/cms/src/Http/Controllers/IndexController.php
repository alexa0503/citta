<?php

namespace Alix\Cms\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
// use Illuminate\Contracts\Encryption\DecryptException;
// use Illuminate\Support\Facades\Crypt;
use DB;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count2 = User::count();
        $count1 = User::where('created_at', '>=', Carbon::today())->count();


        return view('cms::index', [
            'data' => [
                $count1,
                $count2,
            ],
        ]);
    }
    public function clear()
    {
        $can_clear =  time() > strtotime('2020-11-01');
        if ($can_clear) {
            return response([], 403);
        }
        try {
            DB::transaction(function () {
                DB::table('users')->truncate();
                DB::table('invited_users')->truncate();
                DB::table('visits')->truncate();
                DB::table('edm_users')->truncate();
            });
            return response([]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([], 403);
        }
    }
    public function account()
    {
        return view('cms::account.edit');
    }
    public function settings(Request $request)
    {

        if(auth('alix-cms')->user()->id != 1){
            abort(404);
        }
        session(['redirect_uri' => $request->fullUrl()]);
        $setting = Setting::find(1);
        return view('cms::setting.edit', ['item' => $setting]);
    }
    public function updateSettings(Request $request)
    {
        if(auth('alix-cms')->user()->id != 1){
            abort(404);
        }
        $setting = Setting::find(1);
        if (!$setting) {
            $setting = new Setting();
            $setting->name = '活动时间配置';
        }
        $setting->body = [
            'opening_time' => $request->input('opening_time'),
            'live_start_time' => $request->input('live_start_time'),
            'live_end_time' => $request->input('live_end_time'),
            'lijiaqi_live' => $request->input('lijiaqi_live'),
            'inactivated' => $request->input('inactivated'),
        ];
        $setting->save();
        return response()->json(['redirectUri' => session('redirect_uri')]);
    }

    public function inactivatedImages(Request $request)
    {

        if(auth('alix-cms')->user()->id != 1){
            abort(404);
        }
        session(['redirect_uri' => $request->fullUrl()]);
        $setting = Setting::find(2);
        return view('cms::inactivated_images.edit', ['item' => $setting->body ?? []]);
    }
    public function updateInactivatedImages(Request $request)
    {

        if(auth('alix-cms')->user()->id != 1){
            abort(404);
        }
        $setting = Setting::find(2);
        if (!$setting) {
            $setting = new Setting();
            $setting->name = '未激活幻灯片';
        }
        for ($i = 0; $i < 10; $i++) {
            if(!isset($request->input('link')[$i]) || !$request->input('link')[$i]){
                continue;
            }
            $path = null;
            $image_url = null;
            if (isset($request->file('images')[$i]) && $image = $request->file('images')[$i]) {
                $path = $image->store('images', 'public');
            }
            if(isset($setting->body[$i]) && !$path){
                $image_url = $setting->body[$i]['image'];
            }
            else{
                $image_url = $path ? env('CDN_URL') . '/storage/' . $path : '';
            }
            $data[$i] = [
                'link' => $request->input('link')[$i] ?? '',
                'image' => $image_url,
            ];
        }
        $setting->body = $data ?? [];
        $setting->save();
        return response()->json(['redirectUri' => session('redirect_uri')]);
    }
}
