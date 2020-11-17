<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Check extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'code' => $this->code,
            'user_id' => $this->user_id,
            'school_id' => $this->school_id,

        ];
    }
}
