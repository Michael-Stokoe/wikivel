<?php

namespace App\Http\Controllers\Web;

use Log;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(UserService $userService, $id)
    {
        $user = $userService->getById($id);

        return view('domains.user.show', [
            'user' => $user
        ]);
    }

    public function edit(UserService $userService, $id)
    {
        $user = $userService->getById($id);
        
        if (!$user) {
            Log::alert(
                sprintf(
                    'User [%d] tried editing non-existent user [%d]',
                    Auth::id(),
                    $id
                )
            );

            abort(401);
        }

        if (Auth::id() !== $user->id) {
            Log::alert(
                sprintf(
                    'User [%d] tried editing other user [%d]',
                    Auth::id(),
                    $user->id
                )
            );

            abort(401);
        }

        return view('domains.user.edit', [
            'user' => $user
        ]);
    }
}
