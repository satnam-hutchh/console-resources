<?php

namespace Hutchh\Consoleresources\Resources\Miscellaneous;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "code"          => $this->iso3,
            "name"          => $this->name,
            "isoCode"       => $this->iso,
            "countryCode"   => $this->iso3,
            "country"       => $this->name,
            "dialCode"      => $this->dial,
        ];
    }
}
