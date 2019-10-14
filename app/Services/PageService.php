<?php

namespace App\Services;

use App\Models\Page;

class PageService extends ModelService
{
    public function __construct()
    {
        $this->className = Page::class;
    }
}
