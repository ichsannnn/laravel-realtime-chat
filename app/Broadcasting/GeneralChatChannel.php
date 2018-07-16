<?php

namespace App\Broadcasting;

use App\User;
use Auth;
use Log;

class GeneralChatChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        Log::channel('user')->info($user, ['timestamps' => date('Y-m-d H:i:s')]);
        return ['name' => $user->name];
    }
}
