<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function index()
    {
        return view('invite', [
            'pendingInvites' => $pendingInvites,
        ]);
    }

    public function store(Request $request)
    {
        $users = [];

        return view('invite', [
            'invited' => $users,
            'pendingInvites' => $pendingInvites,
        ]);
    }
}
