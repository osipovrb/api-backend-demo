<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalAccessTokenResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            // TBD: доп инфо (браузер, ип, и т.д.)
        ];
    }
}
