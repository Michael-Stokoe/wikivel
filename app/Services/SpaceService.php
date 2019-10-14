<?php

namespace App\Services;

use App\Models\Space;

class SpaceService extends ModelService
{
    public function __construct()
    {
        $this->className = Space::class;
    }
}
