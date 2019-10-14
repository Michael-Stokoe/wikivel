<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SpaceService;
use App\Http\Controllers\Controller;

class SpaceController extends Controller
{
    protected $spaceService;

    public function __construct(SpaceService $spaceService)
    {
        $this->spaceService = $spaceService;
    }

    public function index()
    {
        $spaces = $this->spaceService->all();
    }

    public function show($id)
    {
        $space = $this->spaceService->getById($id);

        return view('admin.space.show', [
            'space' => $space,
        ]);
    }

    public function create()
    {
        return view('admin.space.create');
    }

    public function store(Request $request)
    {
        $space = $request->input('space_file');
        $this->spaceService->create($space);

        return redirect(route('admin.space.show', ['id' => $space->id]));
    }

    public function edit($id, Request $request)
    {
        $space = $this->spaceService->getById($id);

        return view('admin.space.edit', [
            'space' => $space,
        ]);
    }

    public function update($id, Request $request)
    {
        $space = $this->spaceService->getById($id);

        $this->spaceService->update($request);

        return redirect(route('admin.space.show', ['id' => $space->id]));
    }

    public function delete($id, Request $request)
    {
        $space = $this->spaceService->deleteById($id);

        return redirect(route('admin.space.index'));
    }
}
