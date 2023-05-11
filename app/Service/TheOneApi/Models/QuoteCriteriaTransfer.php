<?php

namespace App\Service\TheOneApi\Models;

class QuoteCriteriaTransfer extends BaseTransfer
{
    /**
     * @var string|null $character Character api id
     */
    public ?string $character = null;
    public ?string $dialog = null;
}
