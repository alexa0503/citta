<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Overtrue\LaravelWeChat\Facade as EasyWeChat;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (null == $request->input('code') && env('APP_ENV') == 'production') {
            return response()
                ->json(['code' => 401, 'message' => '缺少code参数'], 200);
        }
        // 测试环境调试
        elseif (null == $request->input('code') && env('APP_ENV') != 'production') {
            $id = $request->input('id') ?: 1;
            $user = User::find($id);
        } else {
            $mini_program = EasyWeChat::MiniProgram();
            $return = $mini_program->auth->session($request->input('code'));
            if ($return && isset($return['errcode'])) {
                return response(['message' => $return['errmsg'], 'code' => 1001], 422);
            }
            $user = User::where('openid', $return['openid'])->first();
            if (!$user) {
                $user = new User;
                $user->openid = $return['openid'];
            }
            //  else if ($user->mobile && !$user->is_activated ) {

            // }
            $user->session_key = $return['session_key'];
            $user->save();
        }
        $token = auth('api')->login($user);
        return $this->respondWithToken($token);
    }
    # 小程序用户信息更新
    public function update(Request $request)
    {
        $user = auth('api')->user();
        if (!$user->session_key || !$request->input('iv') || !$request->input('encryptedData')) {
            return response()->json(['code' => 422, 'message' => '参数不全']);
        }
        $mini_program = EasyWeChat::MiniProgram();
        try {
            $wechat_user = $mini_program->encryptor->decryptData($user->session_key, $request->input('iv'), $request->input('encryptedData'));
            if ($wechat_user) {
                $data = [
                    'openid' => $wechat_user['openId'],
                    'city' => $wechat_user['city'],
                    'country' => $wechat_user['country'],
                    'gender' => $wechat_user['gender'],
                    'nickname' => $wechat_user['nickName'],
                    'province' => $wechat_user['province'],
                    'unionid' => isset($wechat_user['unionId']) ? $wechat_user['unionId'] : null,
                    'avatar' => $wechat_user['avatarUrl'],
                ];
            }
            User::where('openid', $user->openid)
                ->update($data);
        } catch (\Throwable $th) {
            return response()->json(['code' => 2001, 'message' => $th->getMessage()]);
        }
        $user = User::find($user->id);
        return response()->json(['code' => 0, 'data' => new UserResource($user), 'message' => '']);
    }

    public function updateMobile(Request $request)
    {
        $user = auth('api')->user();
        if (!$user->session_key || !$request->input('iv') || !$request->input('encryptedData')) {
            return response()->json(['code' => 422, 'message' => '参数不全']);
        }
        $mini_program = EasyWeChat::MiniProgram();
        try {
            $phoneData = $mini_program->encryptor->decryptData($user->session_key, $request->input('iv'), $request->input('encryptedData'));
            // $phoneData['purePhoneNumber'] = '13661993190';//13661993190
            $userinfo = ['mobile'=>$phoneData['purePhoneNumber']];

            $member = \App\Member::where('mobile',$phoneData['purePhoneNumber'])->first();
            if($member && $member->has_bound == 1 && $member->state == 1){
                $userinfo['is_activated'] = true;
            }
            else{
                $code = 2002;
                $userinfo['is_activated'] = false;
            }
            // $mallcoo_data = (new Mallcoo())->getUserByMobile($phoneData['purePhoneNumber']);
            // if($mallcoo_data && isset($mallcoo_data['Code']) && $mallcoo_data['Code'] == 1){
            //     $userinfo['is_activated'] = true;
            // }
            // else{
            //     $code = 2002;
            //     $userinfo['is_activated'] = false;
            // }
            User::where('openid', $user->openid)
                ->update($userinfo);

        } catch (\Throwable $th) {
            return response()->json(['code' => 2001, 'message' => $th->getMessage()]);
        }
        $user = User::find($user->id);
        return response()->json(['code' => isset($code)?$code:0, 'data' => new UserResource($user), 'message' => '']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth('api')->user(); // ->loadMissing('prizes')
        return response()->json([
            'code' => 0,
            'data' => new UserResource($user)
        ]);
        // return new UserResource($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['code' => 0, 'message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'code' => 0,
            'data' => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]
        ]);
    }

}

