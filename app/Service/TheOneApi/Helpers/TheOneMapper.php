<?php

namespace App\Service\TheOneApi\Helpers;

use App\Service\TheOneApi\Models\CharacterCriteriaTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TheOneMapper
{
    public static function mapResponseCharacterToMassAssignmentArray($characterObj) {
        $values = Arr::except(get_object_vars($characterObj),['_id', 'wikiUrl']);
        $values['api_id'] = $characterObj->_id;
//            some issue while model mapping?
        $values['wiki_url'] = $characterObj->wikiUrl ?? null;
        return $values;
    }
    public static function mapResponseQuoteToMassAssignmentArray($quoteObj) {
        $values = Arr::except(get_object_vars($quoteObj),['_id', 'character', 'movie', 'id']);
        $values['api_id'] = $quoteObj->_id;
//            some issue while model mapping?
        $values['character_api_id'] = $quoteObj->character;
        $values['movie_api_id'] = $quoteObj->movie;
        return $values;
    }

    public static function mapRequestToCharacterCriteria(Request $request) {
        $criteria = new CharacterCriteriaTransfer();
        foreach ($criteria as $key => $value) {
            if($request->input($key)) {
                $criteria->{$key} = $request->input($key);
            }
        }
        return $criteria;
    }
    public static function mapFiltersToCharacterCriteria(Request $request, CharacterCriteriaTransfer $criteria) {
        $data = $request->all();
        foreach ($data as $key => $value) {
//            all values are 'on'
            $arr = explode('_', $key);
            if(count($arr) < 2) {
                continue;
            }
            $categoryName = $arr[0];
            $filter = $arr[1];
            if($criteria->{$categoryName}) {
                $criteria->{$categoryName} .= ',' . static::filterToMap($filter);
            } else {
                $criteria->{$categoryName} = static::filterToMap($filter);
            }
        }
        return $criteria;
    }
    private static function filterToMap(string $filter) {
        $map = [
            'Others' => ['Uruk-hai', 'Black Uruk', 'Raven', 'Balrog', 'Vampire', 'NaN'],
            'Orc' => ['Orcs', 'Orc'],
            'Dragon' => ['Dragon', 'Dragons'],
            'Eagle' => ['Eagle', 'Eagles', 'Great Eagles'],
            'Human' => ['Human', 'Men'],
            'Arthedain' => ['Arthedain', 'Arnor'],];
        if(isset($map[$filter])) {
            return join(',', $map[$filter]);
        }
        return $filter;
    }

    public static function mapUpdateRequestToMassAssignmentArray(Request $request) {
        $values = [];
        $values['wiki_url'] = $request->input('wiki_url');
        $values['race'] = $request->input('race');
        $values['birth'] = $request->input('birth');
        $values['gender'] = $request->input('gender');
        $values['death'] = $request->input('death');
        $values['hair'] = $request->input('hair');
        $values['height'] = $request->input('height');
        $values['realm'] = $request->input('realm');
        $values['spouse'] = $request->input('spouse');
        return $values;
    }
}
