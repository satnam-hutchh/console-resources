<?php

namespace Hutchh\Consoleresources\Resources\Miscellaneous;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Hutchh\Consoleresources\Helpers\Helper;

class BusinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"                    => $this->id, 
            "code"                  => $this->code, 
            "abnNumber"             => $this->abn_number, 
            "acnNumber"             => $this->acn_number, 
            "entityName"            => $this->entity_name, 
            "entityType"            => $this->entity_type, 
            "entityDate"            => $this->entity_date, 
            "abnStatus"             => $this->abn_status, 
            "isGst"                 => !!$this->is_gst, 
            "createdAt"             => $this->created_at,
            "tradingName"           => $this->trading_name,
            'image'                 => Helper::get_business_image($this->image,$this->code),

            "timezone"              => new TimeZoneResource($this),
            'countryDetail'         => new CountryResource($this->countryDetails),
            'currencyDetail'        => new CurrencyResource($this->currencyDetails),
            'statusDetail'          => new StatusResource($this->statusDetails),
        ];
    }
}