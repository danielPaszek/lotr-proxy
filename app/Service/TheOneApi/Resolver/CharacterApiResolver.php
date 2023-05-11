<?php

namespace App\Service\TheOneApi\Resolver;

use App\Models\Character;
use App\Models\LightCharacter;
use App\Service\TheOneApi\Helpers\TheOneMapper;
use App\Service\TheOneApi\Helpers\UrlParser;
use App\Service\TheOneApi\Models\CharacterCriteriaTransfer;
use App\Service\TheOneApi\TheOneApiCaller;
use Illuminate\Database\Eloquent\Collection;

class CharacterApiResolver
{
    private TheOneApiCaller $apiCaller;
    private UrlParser $urlParser;

    public function __construct(TheOneApiCaller $apiCaller, UrlParser $urlParser)
    {
        $this->apiCaller = $apiCaller;
        $this->urlParser = $urlParser;
    }

    /**
     * make request based on criteria, map to character model and
     * save to db when doesn't exist
     * @param CharacterCriteriaTransfer $criteria
     * @return Collection<Character>|null
     * @throws \Exception
     */
    public function resolveCharacters(CharacterCriteriaTransfer $criteria)
    {
        $url = $this->urlParser->buildCharacterUrl($criteria);
        $response = $this->apiCaller->callApi($url);
        $charactersArray = $response->docs;
//        returns array of characters - at least one is required
        if (count($charactersArray) == 0) {
            return null;
        }
        $results = Collection::empty();
        foreach ($charactersArray as $characterObj) {
            $arr = TheOneMapper::mapResponseCharacterToMassAssignmentArray($characterObj);
            $character = Character::where('api_id', $arr['api_id'])->first();
            if(!$character) {
                $character = Character::create($arr);
            }
            $results->push($character);
        }
        return $results;
    }

    public function validateName(string $name) {
        return LightCharacter::where('name', $name)->first();
    }

    /**
     * Supports comma separated values
     * @param CharacterCriteriaTransfer $criteriaTransfer
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCharactersFromDB(CharacterCriteriaTransfer $criteriaTransfer) {
        $query = Character::query();
        foreach ($criteriaTransfer as $key => $value) {
            if($key == 'limit' || $key == 'offset' || $key == 'page' || $key == 'sort') {
                continue;
            }
            if($value) {
                $splitted = explode(',', $value);
                $query->whereIn($key, $splitted);
            }
        }
        return $query->paginate($criteriaTransfer->limit ?? 10, page: $criteriaTransfer->page ?? 1);
    }


}
