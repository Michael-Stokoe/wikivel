<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $images = $this->imageService->all();
    }

    public function show($id)
    {
        $image = $this->imageService->getById($id);

        return view('domains.image.show', [
            'image' => $image,
        ]);
    }

    public function create()
    {
        return view('domains.image.create');
    }

    public function store(Request $request)
    {
        $image = $request->input('image_file');
        $this->imageService->create($image);

        return redirect(route('image.show', ['id' => $image->id]));
    }

    public function edit($id, Request $request)
    {
        $image = $this->imageService->getById($id);

        return view('domains.image.edit', [
            'image' => $image,
        ]);
    }

    public function update($id, Request $request)
    {
        $image = $this->imageService->getById($id);

        $this->imageService->update($request);

        return redirect(route('image.show', ['id' => $image->id]));
    }

    public function delete($id, Request $request)
    {
        $image = $this->imageService->deleteById($id);

        return redirect(route('image.index'));
    }
}
