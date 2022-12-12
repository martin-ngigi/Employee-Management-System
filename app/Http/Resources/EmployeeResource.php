<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'country_name' => $this->country->name,
            'country_id' => $this->country_id,
            'department_id' =>$this->department_id,
            'zip_code' => $this->zip_code,
            'birth_date' => $this->birth_date,
            'date_hired'=>$this->date_hired,

        ];
    }
}
