<?php

namespace App\Models\Repositories;

use App\Models\LightCharacter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LightCharacterRepository implements SearchNamesRepositoryInterface
{
    public function search(string $term, $limit = 10, $page = 1): LengthAwarePaginator
    {
        return LightCharacter::query()->where(fn ($query) => (
            $query->where('name', 'LIKE', "%{$term}%")
        ))->paginate($limit, page: $page);
    }
}
