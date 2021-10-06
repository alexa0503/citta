<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
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
        return [
            'openid' => $this->openid,
            'nickname' => $this->mallcoo_nickname,
            'avatar' => $this->mallcoo_avatar ? asset($this->mallcoo_avatar) : null,
            'points' => $this->points,
            'hasReceived' => $this->mallcoo_id ? true : false,
            'hasJoined' => $this->joined_time === null ? false : true,
            // 'gifts' => UserGfitResource::collection($this->gifts),
            'oauthUri' => url('oauth'),
            'updatedAt' => $this->updated_at->format('Y-m-d H:i:s'),
            'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
