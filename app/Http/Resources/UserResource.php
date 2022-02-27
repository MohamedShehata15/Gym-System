<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'name'=>$this->name,
             'id'=>$this->id,
             'email'=>$this->email,
             'gender'=>$this->gender,
             'avatar'=>$this->avatar,
             'attendance_session'=>$this->attendance_session
        ];
    }
}
