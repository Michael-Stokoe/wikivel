<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\InvitationService;
use App\Http\Controllers\Controller;

class InviteController extends Controller
{
    public function index(InvitationService $invitationService)
    {
        $pendingInvites = $invitationService->getPendingInvites();

        return view('invite', [
            'pendingInvites' => $pendingInvites,
        ]);
    }

    public function store(Request $request, InvitationService $invitationService)
    {
        $pendingInvites = $invitationService->getPendingInvites();

        $validatedInvites = $invitationService->validateRequestInput($request);

        //TODO: Finish me

        return view('invite', [
            'successfulInvitations' => $successfulInvitations,
            'failedInvitations' => $failedInviations,
            'pendingInvites' => $pendingInvites,
        ]);
    }
}
