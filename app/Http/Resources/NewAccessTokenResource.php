<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewAccessTokenResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->accessToken->id,
            'access_token' => $this->plainTextToken,
        ];
    }
}
