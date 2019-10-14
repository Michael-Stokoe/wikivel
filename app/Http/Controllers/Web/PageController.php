<?php

namespace App\Http\Controllers\Web;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Services\PageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditModelDataRequest;

class PageController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index()
    {
        $pages = $this->pageService->all();
    }

    public function show(Page $page)
    {
        $commentable_type = 'App\Models\Page';
        $commentable_id = $page->id;
        $likeable_type = 'App\\\Models\\\Page';
        $likeable_id = $page->id;

        return view('domains.page.show', [
            'page' => $page,
            'commentable_type' => $commentable_type,
            'commentable_id' => $commentable_id,
            'likeable_type' => $likeable_type,
            'likeable_id' => $likeable_id,
        ]);
    }

    public function create()
    {
        return view('domains.page.create');
    }

    public function store(Request $request)
    {
        $page = $request->input('page_file');
        $this->pageService->create($page);

        return redirect(route('page.show', ['page' => $page]));
    }

    public function edit(Page $page)
    {
        return view('domains.page.edit', [
            'page' => $page,
        ]);
    }

    public function update(Page $page, EditModelDataRequest $request)
    {
        $page->update(
            [
                'name' => $request->input('name'),
                'content' => $request->input('content')
            ]
        );

        return redirect(route('page.show', ['page' => $page]));
    }

    public function delete(Page $page)
    {
        $space = $page->space;
        $page->delete();

        return redirect(route('space.show', ['space' => $space]));
    }
}
