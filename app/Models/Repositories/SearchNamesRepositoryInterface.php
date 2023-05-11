<?php

namespace App\Models\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface SearchNamesRepositoryInterface
{
    public function search(string $term): LengthAwarePaginator;
}
