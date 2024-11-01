<?php

namespace Hutchh\Consoleresources\Resources\Miscellaneous;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class TimeZoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        try{
            $dateTime = new CarbonTimeZone($this->timezone);
        }catch(\Exception $e){
            Log::info($e->getMessage());
            return [];
        }
        $dateTime = new CarbonTimeZone($this->timezone);
        return [
            "regionName"    => $dateTime->toRegionName(),
            "offsetName"    => $dateTime->toOffsetName(),
            "offsetType"    => "UTC",
        ];
    }
}
