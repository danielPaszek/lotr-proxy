<?php

namespace App\Service\TheOneApi\Models;

/**
 * use url safe characters and ',' as separator
 */
class CharacterCriteriaTransfer extends BaseTransfer
{
    public ?string $name = null;
    public ?string $race = null;
    public ?string $gender = null;
    public ?string $hair = null;
    public ?string $realm = null;
    public ?string $spouse = null;


}
