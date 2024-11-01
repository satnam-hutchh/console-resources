<?php

namespace Hutchh\Consoleresources\Resources\Miscellaneous;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PanelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this->id,
            "code"          => $this->code,
            "name"          => $this->name,
            "description"   => $this->description,
        ];
    }
}
