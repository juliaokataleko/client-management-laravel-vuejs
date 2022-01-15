<?php

namespace App\Http\Resources;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $newDate = date("d-m-Y H:i:s", strtotime($this->created_at));
        $birthday = date("d-m-Y", strtotime($this->birthday));


        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birthday' => $birthday,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,

            'country' => $this->country ?? new Country(),
            'state' => $this->state ?? new State(),
            'city' => $this->city ?? new City(),

            'address' => $this->address,
            'created_at' => $newDate
        ];
    }
}
