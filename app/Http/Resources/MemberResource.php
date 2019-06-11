<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->first_name . ' ' . $this->last_name
        ];
        //return parent::toArray($request);
    }
}
