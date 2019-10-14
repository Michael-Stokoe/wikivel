<?php

namespace App\Http\View\Composers;

use Auth;
use Illuminate\View\View;

class RecentActivityComposer
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function compose(View $view)
    {
        // If there's a user logged in...
        if ($this->user) {
            // Get a list of their recent changes.
            $usersRecentWikis = $this->user->getRecentWikis();

            $favoriteWikis = $this->user->getFavoriteWikis();

            if (count($favoriteWikis) > 0) {
                $sideBarWikis = $favoriteWikis;
            } else {
                $sideBarWikis = $this->user->getRecentWikis();
            }

            $usersRecentSpaces = $this->user->getRecentSpaces();
            $usersRecentPages = $this->user->getRecentPages();
        } else {
            // There's no user logged in, instantiate the required variables as empty collections and move on.
            $usersRecentWikis = collect();
            $usersRecentSpaces = collect();
            $usersRecentPages = collect();
            $sideBarWikis = collect();
        }

        $view->with(
            [
                'usersRecentWikis' => $usersRecentWikis,
                'usersRecentSpaces' => $usersRecentSpaces,
                'usersRecentPages' => $usersRecentPages,
                'sideBarWikis' => $sideBarWikis,
            ]
        );
    }
}
