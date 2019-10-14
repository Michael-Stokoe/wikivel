<?php

namespace App\Services;

use App\Models\Image;

class ImageService extends ModelService
{
    public function __construct()
    {
        $this->className = Image::class;
    }
}
