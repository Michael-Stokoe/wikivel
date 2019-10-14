<?php

namespace App\Http\Controllers\Web;

use Parsedown;
use App\Models\Wiki;
use Illuminate\Http\Request;
use App\Services\WikiService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditModelDataRequest;

class WikiController extends Controller
{
    protected $wikiService;

    public function __construct(WikiService $wikiService)
    {
        $this->wikiService = $wikiService;
    }

    public function show(Wiki $wiki)
    {
        $commentable_type = 'App\Models\Wiki';
        $commentable_id = $wiki->id;
        $likeable_type = 'App\\\Models\\\Wiki';
        $likeable_id = $wiki->id;

        return view('domains.wiki.show', [
            'wiki' => $wiki,
            'commentable_type' => $commentable_type,
            'commentable_id' => $commentable_id,
            'likeable_type' => $likeable_type,
            'likeable_id' => $likeable_id,
        ]);
    }

    public function index()
    {
        $wikis = $this->wikiService->all();

        return view('domains.wiki.index', [
            'wikis' => $wikis,
        ]);
    }

    public function create()
    {
        return view('domains.wiki.create');
    }

    public function store(Request $request)
    {
        $wiki = $request->input('wiki_file');
        $this->wikiService->create($wiki);

        return redirect(route('wiki.show', ['wiki' => $wiki]));
    }

    public function edit(Wiki $wiki)
    {
        return view('domains.wiki.edit', [
            'wiki' => $wiki
        ]);
    }

    public function update(Wiki $wiki, EditModelDataRequest $request)
    {
        $wiki->update(
            [
                'name' => $request->input('name'),
                'content' => $request->input('content')
            ]
        );

        return redirect(route('wiki.show', ['wiki' => $wiki]));
    }

    public function delete(Wiki $wiki)
    {
        $wiki->delete();

        return redirect(route('home'));
    }
}
