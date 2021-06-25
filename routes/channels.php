<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

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

Broadcast::channel('acceptRequest2.{id}', function ($user, $id) {
    return Auth::check();
});

Broadcast::channel('onlineFriend', function () {
    return Auth::check();
});

Broadcast::channel('offlineFriend', function () {
    return Auth::check();
});

Broadcast::channel('sendText.{id}', function ($user, $id) {
    return Auth::check();
});

Broadcast::channel('newPost', function () {
	return Auth::check(); 
}); 

Broadcast::channel('likePost.{id}', function () {
	return Auth::check(); 
}); 

Broadcast::channel('likeComment.{id}', function () {
	return Auth::check(); 
}); 

Broadcast::channel('Comment.{id}', function () {
	return Auth::check(); 
}); 

Broadcast::channel('sharePost.{id}', function () {
	return Auth::check(); 
}); 

Broadcast::channel('Notification.{id}', function () {
	return Auth::check(); 
}); 

Broadcast::channel('newStory', function () {
	return Auth::check(); 
}); 

