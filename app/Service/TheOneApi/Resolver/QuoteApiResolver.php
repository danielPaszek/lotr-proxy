<?php

namespace App\Service\TheOneApi\Resolver;

use App\Models\Character;
use App\Models\Quote;
use App\Service\TheOneApi\Helpers\TheOneMapper;
use App\Service\TheOneApi\Helpers\UrlParser;
use App\Service\TheOneApi\Models\QuoteCriteriaTransfer;
use App\Service\TheOneApi\TheOneApiCaller;

class QuoteApiResolver
{
    private TheOneApiCaller $apiCaller;
    private UrlParser $urlParser;

    public function __construct(TheOneApiCaller $apiCaller, UrlParser $urlParser)
    {
        $this->apiCaller = $apiCaller;
        $this->urlParser = $urlParser;
    }

    public function resolveQuotes(QuoteCriteriaTransfer $criteriaTransfer) {
        $url = $this->urlParser->buildQuoteUrl($criteriaTransfer);
        $response = $this->apiCaller->callApi($url);
        $quotesArr = $response->docs;
        if (count($quotesArr) == 0) {
            return [null];
        }
        $results = [];
        foreach ($quotesArr as $quoteObj) {
            $arr = TheOneMapper::mapResponseQuoteToMassAssignmentArray($quoteObj);
            $quote = Quote::where('api_id', $arr['api_id'])->first();
            if(!$quote) {
                $quote = Quote::create($arr);
            }
            $results []= $quote;
        }
        return $results;
    }
}
