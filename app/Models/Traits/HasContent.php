<?php

namespace App\Models\Traits;

use Parsedown;
use Illuminate\Support\HtmlString;

trait HasContent
{
    public function getContentAsHtml()
    {
        if (isset($this->{$this->contentField}) && !empty($this->{$this->contentField})) {
            return new HtmlString(
                app(Parsedown::class)->setSafeMode(0)->text($this->{$this->contentField})
            );
        }

        return null;
    }

    public function getContentAsMarkdown()
    {
        if (isset($this->{$this->contentField}) && !empty($this->{$this->contentField})) {
            return $this->{$this->contentField};
        }

        return null;
    }
}
