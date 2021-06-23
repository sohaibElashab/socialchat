<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use DateTime;
use App\Models\Notification;


class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $id_to;
    public $id_post;
    public $type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id_to,$id_post,$type)
    {
        $this->id_to = $id_to;
        $this->id_post = $id_post;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Notification.'.$this->id_to);
        
    }

    public function broadcastWith()
    {
        date_default_timezone_set('Africa/Casablanca');
        $notif = Notification::create([
            'user_id' => $this->id_to,
            'user_from' => auth()->user()->id,
            'post_id' => $this->id_post,
            'type' => $this->type,
            'time' => date("Y-m-d H:i:s")
        ]);
        $user = auth()->user();
        $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
       
        $notif->time = 'Just Now';
        $notif->userImg = 'images/user/'.$user->profileimg->name;
        $notif->userName = $user->name;
        $notif->userId = $user->id;

        if ($this->type == 'like_post') {
            $notif->WhatDo = "Liked your Post";
        }elseif ($this->type == 'like_comment') {
            $notif->WhatDo = "Liked your Comment";
        }elseif ($this->type == 'comment') {
            $notif->WhatDo = "Commented on your post";
        }elseif ($this->type == 'request') {
            $notif->WhatDo = "Sent a Friend Request";
        }elseif ($this->type == 'share') {
            $notif->WhatDo = "Shared Your Post";
        }
       
        return ['notif' => $notif];
    } 
}
