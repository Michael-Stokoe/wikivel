<?php

namespace App\Services;

use App\Models\Wiki;

class WikiService extends ModelService
{
    public function __construct()
    {
        $this->className = Wiki::class;
    }
}
