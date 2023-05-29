<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterResource;
use App\Http\Resources\LightCharacterResource;
use App\Models\Helpers\CharacterFiller;
use App\Models\Image;
use App\Models\Repositories\SearchNamesRepositoryInterface;
use App\Service\TheOneApi\Helpers\TheOneMapper;
use App\Service\TheOneApi\Models\QuoteCriteriaTransfer;
use App\Service\TheOneApi\TheOneApiProxyFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use stdClass;

class CharacterController extends Controller
{
    private TheOneApiProxyFacade $theOneApiFacade;
    private SearchNamesRepositoryInterface $searchNamesRepository;

    public function __construct(TheOneApiProxyFacade $theOneApiFacade, SearchNamesRepositoryInterface $searchNamesRepository)
    {
        $this->theOneApiFacade = $theOneApiFacade;
        $this->searchNamesRepository = $searchNamesRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $criteria = TheOneMapper::mapRequestToCharacterCriteria($request);
        $characters = $this->theOneApiFacade->getCharacters($criteria);
        if(!$characters) {
            return response()->json(new stdClass());
        }
        $characters->load('images');

        return CharacterResource::collection($characters);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name, Request $request)
    {
        $character = $this->theOneApiFacade->getCharacterByName($name);
        if(!$character) {
//            TODO: add total
            return response()->json(new stdClass());
        }
        $quoteCriteria = new QuoteCriteriaTransfer();
        $quoteCriteria->character = $character->api_id;
        $quoteCriteria->page = $request->input('page', 1);
        $quotes = $this->theOneApiFacade->getQuotesByCharactersApiId($quoteCriteria);
        $character->setRelation('quotes', $quotes);

        $character->load('images');
        return CharacterResource::make($character);
    }

    public function listNames(Request $request) {
        $q = $request->input('q');
        if(!$q) {
            return response()->json(new stdClass());
        }
        $limit = $request->input('limit', 20);
        $page = $request->input('page', 1);
        $charactersLight = $this->searchNamesRepository->search($q, $limit, $page);
        return LightCharacterResource::collection($charactersLight);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $name )
    {
//        TODO: authorization
        $character = $this->theOneApiFacade->getCharacterByName($name);
        $values = TheOneMapper::mapUpdateRequestToMassAssignmentArray($request);
        $character = CharacterFiller::fillExistingCharacterWithMassAssignmentArray($character, $values);
        $character->save();
        $images = Collection::empty();
        foreach ($request->all() as $key => $value) {
            if(str_starts_with($key, 'image')) {
                $img = Image::firstOrCreate(['url' => $value, 'characters_api_id' => $character->api_id]);
                $images->push($img);
            }
        }
//        firstOrCreate inserts automatically
        return response()->json(['success' => true]);
    }

}
