<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

// use App\Http\Resources\UserGfitResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $mallcoo = new \App\Mallcoo();
        //剩余礼物次数
        $count2 = env('MAX_GIFT_NUMBER_2') - DB::table('user_gifts')->where('user_id', $this->id)->where('name', 2)->count();
        $count3 = env('MAX_GIFT_NUMBER_3') - DB::table('user_gifts')->where('user_id', $this->id)->where('name', 3)->count();
        $teams = \App\Helper::teams();
        return [
            'openid' => $this->openid,
            'nickname' => $this->mallcoo_nickname,
            'mobile' => $this->mallcoo_mobile,
            'avatar' => $this->mallcoo_avatar ? asset($this->mallcoo_avatar) : null,
            'points' => $this->points,
            'hasReceived' => $this->mallcoo_has_received == 1 ? true : false,
            'remainingGiftNumber' => [$count2, $count3],
            // 'hasJoined' => $this->joined_time === null ? false : true,
            'team' => $this->team,
            'joinedNumber' => $teams['joinedNumber'],
            // 'gifts' => UserGfitResource::collection($this->gifts),
            'oauthUri' => $mallcoo->oAuthRedirectUri(),
            'updatedAt' => $this->updated_at->format('Y-m-d H:i:s'),
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
