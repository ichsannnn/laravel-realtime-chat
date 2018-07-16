<?php

use App\Broadcasting\GeneralChatChannel;

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


Broadcast::channel('general-chat-channel', GeneralChatChannel::class);
