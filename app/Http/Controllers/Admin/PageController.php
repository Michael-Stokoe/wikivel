<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\PageService;
use App\Http\Controllers\Controller;

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

    public function show($id)
    {
        $page = $this->pageService->getById($id);

        return view('admin.page.show', [
            'page' => $page,
        ]);
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request)
    {
        $page = $request->input('page_file');
        $this->pageService->create($page);

        return redirect(route('admin.page.show', ['id' => $page->id]));
    }

    public function edit($id, Request $request)
    {
        $page = $this->pageService->getById($id);

        return view('admin.page.edit', [
            'page' => $page,
        ]);
    }

    public function update($id, Request $request)
    {
        $page = $this->pageService->getById($id);

        $this->pageService->update($request);

        return redirect(route('admin.page.show', ['id' => $page->id]));
    }

    public function delete($id, Request $request)
    {
        $page = $this->pageService->deleteById($id);

        return redirect(route('admin.page.index'));
    }
}
