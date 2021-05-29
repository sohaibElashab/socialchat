<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('sendRequest.{id}', function ($user, $id) {
    return Auth::check();
});

Broadcast::channel('cancelRequest.{id}', function ($user, $id) {
    return Auth::check();
});

Broadcast::channel('acceptRequest.{id}', function ($user, $id) {
    return Auth::check();
});

Broadcast::channel('onlineFriend', function () {
    return Auth::check();
});

Broadcast::channel('offlineFriend', function () {
    return Auth::check();
});

Broadcast::channel('users', function ($user) {
    return $user;
});