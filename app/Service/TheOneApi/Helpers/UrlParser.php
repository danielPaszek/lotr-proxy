<?php

namespace App\Service\TheOneApi\Helpers;

use App\Service\TheOneApi\Models\BaseTransfer;
use App\Service\TheOneApi\Models\CharacterCriteriaTransfer;
use App\Service\TheOneApi\Models\QuoteCriteriaTransfer;

class UrlParser
{

    /**
     * Defaults limit to 10
     * @param CharacterCriteriaTransfer $criteria
     * @return string
     */
    public function buildCharacterUrl(CharacterCriteriaTransfer $criteria)
    {
        $url = 'character?';
        $url = $this->mapKeysToParams($criteria, $url);
        return $url;
    }

    /**
     * Defaults limit to 10
     * @return string
     */
    public function buildQuoteUrl(QuoteCriteriaTransfer $criteria)
    {
        $url = 'quote?';
        $url = $this->mapKeysToParams($criteria, $url);
        return $url;
    }

    /**
     * @param CharacterCriteriaTransfer $criteria
     * @param string $url
     * @return string
     */
    public function mapKeysToParams(BaseTransfer $criteria, string $url): string
    {
        foreach ($criteria as $key => $value) {
            if ($key == 'limit' && !$value) {
                $url .= "$key=10&";
            }
            if ($value) {
                $url .= "$key=$value&";
            }
        }
        return $url;
    }
}
