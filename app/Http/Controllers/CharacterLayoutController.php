<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterResource;
use App\Http\Resources\LightCharacterResource;
use App\Models\Character;
use App\Models\Helpers\CharacterFiller;
use App\Models\Image;
use App\Models\Repositories\SearchNamesRepositoryInterface;
use App\Service\TheOneApi\Helpers\TheOneMapper;
use App\Service\TheOneApi\Models\QuoteCriteriaTransfer;
use App\Service\TheOneApi\TheOneApiConsts;
use App\Service\TheOneApi\TheOneApiProxyFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CharacterLayoutController extends Controller
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
        $msg = Session::pull('message');
        $msgClass = Session::pull('msgClass');
        $criteria = TheOneMapper::mapRequestToCharacterCriteria($request);
        $criteria = TheOneMapper::mapFiltersToCharacterCriteria($request, $criteria);
        $criteria->limit = $request->input('limit', 12);
        $characters = $this->theOneApiFacade->getCharacters($criteria);
        $characters->load('images');
        return view('characters.index', ['characters' => $characters, 'page' => $criteria->page ?? 1,
            'categories' => TheOneApiConsts::CATEGORIES, 'message' => $msg, 'msgClass' => $msgClass]);

    }

    /**
     * Display a list of names
     */
    public function listNames(Request $request) {
        $q = $request->input('q');
        if(!$q) {
            return response()->json(new \stdClass());
        }
        $limit = $request->input('limit', 30);
        $page = $request->input('page', 1);
        $charactersLight = $this->searchNamesRepository->search($q, $limit, $page);
        return view('characters.list', ['characters' => $charactersLight, 'page' => $page, 'q' => $q]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name, Request $request)
    {
        $character = $this->theOneApiFacade->getCharacterByName($name);

        $quoteCriteria = new QuoteCriteriaTransfer();
        $quoteCriteria->character = $character->api_id;
        $quoteCriteria->page = $request->input('page', 1);
        $quotes = $this->theOneApiFacade->getQuotesByCharactersApiId($quoteCriteria);
        $character->setRelation('quotes', $quotes);

        $character->load('images');
        return view('characters.show', ['character' => $character, 'page' => $quoteCriteria->page ?? 1]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $name, Request $request)
    {
        $character = $this->theOneApiFacade->getCharacterByName($name);
        $character->load('images');
        return view('characters.edit', ['character' => $character]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $name)
    {
        $character = $this->theOneApiFacade->getCharacterByName($name);
        //        TODO: authorization
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
        Session::put('message', 'Successfully updated character');
        Session::put('msgClass', 'alert alert-success');
        return redirect('/');
    }

}
