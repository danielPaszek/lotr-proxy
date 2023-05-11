<?php

namespace App\Service\TheOneApi\Models;

class BaseTransfer
{
    public ?string $api_id = null;
    public ?string $limit = null;
    public ?string $offset = null;
    public ?string $page = null;
    public ?string $sort = null;
}
