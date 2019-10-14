<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Conner\Likeable\Likeable;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasContent;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Artisanry\Commentable\Traits\HasComments;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model implements Searchable
{
    use
        LogsActivity,
        SoftDeletes,
        HasContent,
        HasTags,
        HasSlug,
        Likeable,
        HasComments;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $appends = [
        'tagged_with'
    ];

    public $slugColumn = 'name';

    public $contentField = 'content';

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'pages_index';
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function user()
    {
        return $this->belongsto(User::class);
    }

    public function getUrl()
    {
        return route('page.show', ['page' => $this]);
    }

    public function getTaggedWithAttribute()
    {
        return $this->taggedWith = $this->tags;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('page.show', ['page' => $this]);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
