<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\FriendRequest;
use App\Models\User;
use App\Models\Image;
use App\Models\Friend;

class CancelRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Frequest;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FriendRequest $Frequest)
    {
        $this->Frequest = $Frequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('cancelRequest.'.$this->Frequest->user_to);
    }

    public function broadcastWith()
    {
       // user_from id 
        $user = User::where('id',$this->Frequest->user_from)->first(['id','name']);
        $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        $user->FriendCount = $this->FriendCount($user->id);
        return ['user' => $user];
    } 

    public function FriendCount($id)
    {
        $friends = Friend::where('user_id',$id)->orWhere('friend_id',$id)->get();
        $new = collect();
        foreach ($friends as $key => $friend) {
            if($friend->user_id != $id){
                $new->add($friend->user_id);
            } elseif ($friend->friend_id != $id) {
                $new->add($friend->friend_id);
            }
        }
        $new = $new->unique();
        $friends = User::whereIn('id',$new)->get();

        return $friends->count();
    }
}
 