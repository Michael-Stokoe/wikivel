<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->getAllFavorites();

        return view('favorites', [
            'favorites' => $favorites,
        ]);
    }

    public function toggle(Request $request)
    {
        $likeable_type = $request->input('likeable_type');
        $likeable_id = $request->input('likeable_id');

        $record = $likeable_type::where('id', $likeable_id)->first();

        if (!$record) {
            abort(404);
        }

        try {
            if ($record->liked()) {
                $record->unlike();
            } else {
                $record->like();
            }

            return response('', 200);
        } catch (\Exception $e) {
            abort(401);
        }
    }
}
