<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Searchable
{
    use Notifiable, HasRoles, CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'display_picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The default attributes that should be stored against the record.
     *
     * @var array
     */
    protected $attributes = [
        'display_picture' => 'default.png',
    ];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'users_index';
    }

    public function scopeAdminUsers()
    {
        return $this->hasRole('admin');
    }

    public function getAllFavorites()
    {
        $wikis = $this->getFavoriteWikis();
        $spaces = $this->getFavoriteSpaces();
        $pages = $this->getFavoritePages();

        return collect(['wikis' => $wikis, 'spaces' => $spaces, 'pages' => $pages]);
    }

    public function getFavoriteWikis()
    {
        $limit = config('wiki.sidebar.wikis_to_show');

        $wikis = Wiki::whereLikedBy($this->id)->limit($limit)->get();

        return $wikis;
    }

    public function getFavoriteSpaces()
    {
        $limit = config('wiki.sidebar.spaces_to_show');

        $wikis = Space::whereLikedBy($this->id)->limit($limit)->get();

        return $wikis;
    }

    public function getFavoritePages()
    {
        $limit = config('wiki.sidebar.pages_to_show');

        $wikis = Page::whereLikedBy($this->id)->limit($limit)->get();

        return $wikis;
    }

    public function getRecentWikis()
    {
        $limit = config('wiki.sidebar.wikis_to_show');

        $wikiIds = $this->actions()
            ->where('subject_type', 'App\Models\Wiki')
            ->whereIn('description', ['created', 'updated'])
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->pluck('subject_id');

        $wikis = Wiki::whereIn('id', $wikiIds)->get();

        return $wikis;
    }

    public function getRecentSpaces()
    {
        $limit = config('wiki.sidebar.spaces_to_show');

        $spaceIds = $this->actions()
            ->where('subject_type', 'App\Models\Space')
            ->whereIn('description', ['created', 'updated'])
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->pluck('subject_id');

        $spaces = Space::whereIn('id', $spaceIds)->get();

        return $spaces;
    }

    public function getRecentPages()
    {
        $limit = config('wiki.sidebar.pages_to_show');

        $pageIds = $this->actions()
            ->where('subject_type', 'App\Models\Page')
            ->whereIn('description', ['created', 'updated'])
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->pluck('subject_id');

        $pages = Page::whereIn('id', $pageIds)->get();

        return $pages;
    }

    public function getDisplayPictureUrl()
    {
        $picture = $this->display_picture ?? 'default-user-image.png';
        return url(
            sprintf(
                'storage/display_pictures/%s',
                $picture
            )
        );
    }

    public function getUrl()
    {
        return route('user.show', [
            'id' => $this->id
        ]);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('user.show', ['id' => $this->id]);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
