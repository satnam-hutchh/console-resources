<?php

namespace App\Http\Resources\Miscellaneous;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "isoCode"       => $this->iso,
            "countryCode"   => $this->iso3,
            "country"       => $this->name,
            "code"          => $this->currency,
            "name"          => $this->currency_name,
        ];
    }
}
