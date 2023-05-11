<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'quotes' => QuoteResource::collection($this->whenLoaded('quotes')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            $this->merge(
                Arr::except(
                    parent::toArray($request),
                    ['id', 'api_id', 'created_at', 'updated_at', 'full_fetched']
                )
            )
        ];
    }
}
