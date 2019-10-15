<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class InvitationService
{
    public function inviteUsers($users)
    {
        //
    }

    public function cancelInvites($users)
    {
        //
    }

    public function getPendingInvites()
    {
        //
    }

    public function validateRequestInput(Request $request)
    {
        $usersToInviteCount = $request->input('users_to_invite_count');
        
        $usersToInvite = [];
        $failedInviations = [];

        for ($i = 0; $i < $usersToInviteCount; ++$i) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $usersToInvite[] = $this->extractUserDetails($request, $i);
            } else {
                $failedInviations[] = $this->extractUserDetails($request, $i);
            }
        }

        return collect($usersToInvite, $failedInviations)->recursive();
    }

    public function extractUserDetails(Request $request, int $i)
    {
        $name = sprintf('user_%s_name', $i);
        $email = sprintf('user_%s_email', $i);

        return [
            'name' => $request->input($name),
            'email' => $request->input($email)
        ];
    }
}
