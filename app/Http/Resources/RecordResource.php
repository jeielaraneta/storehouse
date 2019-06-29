<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //$id = ($this->agc != NULL) ? $this->agc : (($this->group_name != NULL) ? $this->group_name : $this->member_id);

        $id = '';

        switch ($this->giver_type) {
            case 'identified':
                $id = $this->member->first_name;
                break;

            case 'group':
                $id = $this->group_name;
                break;
            
            default:
                $id = $this->agc;
                break;
        }
        
        return [
            'id' => "$id",
            'giver_type' => $this->giver_type,
            'given_at' => $this->given_at,
            'love_amount' => $this->love_amount,
            'tithe_amount' => $this->tithe_amount,
            'faith_amount' => $this->faith_amount,
            'total_amount' => $this->total_amount,
            'status' => $this->status
        ];
        //return parent::toArray($request);
    }
}
