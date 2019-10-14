<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\WikiService;
use App\Http\Controllers\Controller;

class WikiController extends Controller
{
    protected $wikiService;

    public function __construct(WikiService $wikiService)
    {
        $this->wikiService = $wikiService;
    }

    public function index()
    {
        $wikis = $this->wikiService->all();
    }

    public function show($id)
    {
        $wiki = $this->wikiService->getById($id);

        return view('admin.wiki.show', [
            'wiki' => $wiki,
        ]);
    }

    public function create()
    {
        return view('admin.wiki.create');
    }

    public function store(Request $request)
    {
        $wiki = $request->input('wiki_file');
        $this->wikiService->create($wiki);

        return redirect(route('admin.wiki.show', ['id' => $wiki->id]));
    }

    public function edit($id, Request $request)
    {
        $wiki = $this->wikiService->getById($id);

        return view('admin.wiki.edit', [
            'wiki' => $wiki,
        ]);
    }

    public function update($id, Request $request)
    {
        $wiki = $this->wikiService->getById($id);

        $this->wikiService->update($request);

        return redirect(route('admin.wiki.show', ['id' => $wiki->id]));
    }

    public function delete($id, Request $request)
    {
        $wiki = $this->wikiService->deleteById($id);

        return redirect(route('admin.wiki.index'));
    }
}
