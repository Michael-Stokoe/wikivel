<?php

namespace App\Http\Controllers\Web;

use App\Models\Page;
use App\Models\User;
use App\Models\Wiki;
use App\Models\Space;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    protected $searchResultLimit;

    public function __construct()
    {
        $this->searchResultLimit = config('wiki.search.result_limit');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $searchResults = (new Search())
            ->registerModel(Wiki::class, ['name'])
            ->registerModel(Space::class, ['name'])
            ->registerModel(Page::class, ['name'])
            ->perform($searchTerm);

        return new JsonResponse($searchResults->take($this->searchResultLimit));
    }
}
