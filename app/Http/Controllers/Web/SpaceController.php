<?php

namespace App\Http\Controllers\Web;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Services\SpaceService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditModelDataRequest;

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

    public function show(Space $space)
    {
        $commentable_type = 'App\Models\Space';
        $commentable_id = $space->id;
        $likeable_type = 'App\\\Models\\\Space';
        $likeable_id = $space->id;
        
        return view('domains.space.show', [
            'space' => $space,
            'commentable_type' => $commentable_type,
            'commentable_id' => $commentable_id,
            'likeable_type' => $likeable_type,
            'likeable_id' => $likeable_id,
        ]);
    }

    public function create()
    {
        return view('domains.space.create');
    }

    public function store(Request $request)
    {
        $space = $request->input('space_file');
        $this->spaceService->create($space);

        return redirect(route('space.show', ['space' => $space]));
    }

    public function edit(Space $space)
    {
        return view('domains.space.edit', [
            'space' => $space,
        ]);
    }

    public function update(Space $space, EditModelDataRequest $request)
    {
        $space->update(
            [
                'name' => $request->input('name'),
                'content' => $request->input('content')
            ]
        );

        return redirect(route('space.show', ['space' => $space]));
    }

    public function delete(Space $space)
    {
        $wiki = $space->wiki;
        $space->delete();
        return redirect(route('wiki.show', ['wiki' => $wiki]));
    }
}
