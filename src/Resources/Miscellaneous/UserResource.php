<?php

namespace Hutchh\Consoleresources\Resources\Miscellaneous;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Hutchh\Consoleresources\Helpers\Helper;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'code'          => $this->code,
            'firstName'     => $this->first_name,
            'lastName'      => $this->last_name,
            'fullName'      => $this->full_name,
            'image'         => Helper::get_profile_image($this->profile_image,$this->email),
            'phone'         => $this->phone,
            'email'         => $this->email,
            'createdAt'     => $this->created_at,
        ];
    }
}
