<?php

namespace App\Service\TheOneApi;

use App\Models\Character;
use App\Models\Quote;
use App\Service\TheOneApi\Helpers\TheOneMapper;
use App\Service\TheOneApi\Models\CharacterCriteriaTransfer;
use App\Service\TheOneApi\Models\QuoteCriteriaTransfer;
use App\Service\TheOneApi\Resolver\CharacterApiResolver;
use App\Service\TheOneApi\Resolver\QuoteApiResolver;
use Illuminate\Http\Request;

class TheOneApiProxyFacade
{
    private CharacterApiResolver $characterApiResolver;
    private QuoteApiResolver $quoteApiResolver;

    public function __construct(CharacterApiResolver $characterApiResolver, QuoteApiResolver $quoteApiResolver)
    {
        $this->characterApiResolver = $characterApiResolver;
        $this->quoteApiResolver = $quoteApiResolver;
    }

    public function getCharacters(CharacterCriteriaTransfer $criteria) {
        $characters = $this->characterApiResolver->getCharactersFromDB($criteria);
        if($characters->isEmpty()) {
            $characters = $this->characterApiResolver->resolveCharacters($criteria);
//            refetch with lower page, because you could have partial set
            if(!$characters && $criteria->page > 1) {
                $criteria->page--;
                $characters = $this->characterApiResolver->resolveCharacters($criteria);
            }
        }
        return $characters;
    }

    /**
     * Checks if it was saved, makes external request when not found
     * @param string $name
     * @return Character|null
     * @throws \Exception
     */
    public function getCharacterByName(string $name) {
        if(!$this->characterApiResolver->validateName($name)) {
            abort(404, 'Provided character doesnt exists');
        }
        $character = Character::where('name', $name)->first();
        if(!$character) {
            $criteria = new CharacterCriteriaTransfer();
            $criteria->name = $name;
            $characters = $this->characterApiResolver->resolveCharacters($criteria);
            if(!$characters) {
                return null;
            }
            return $characters->first();
        }
        return $character;

    }

    public function getQuotesByCharactersApiId(QuoteCriteriaTransfer $criteria) {
        $character = Character::where('api_id', $criteria->character)->first();
        $quotes = Quote::query()->where('character_api_id', $criteria->character)->paginate($criteria->limit ?? 10, page: $criteria->page ?? 1);

        if($quotes->isEmpty() && $character->full_fetched) {
            return [null];
        }

        if($quotes->isEmpty()) {

            $quotes = $this->quoteApiResolver->resolveQuotes($criteria);
//            no more quotes
            if(count($quotes) < ($criteria->limit ?? 10)) {
                $character->full_fetched = TheOneApiConsts::QUOTES_FETCHED;
                $character->save();
            }

        }
        return $quotes;
    }


}
