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

use DateTime as GlobalDateTime;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Array_;

class NewPostEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $post;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('newPost');
    }

   public function broadcastWith()
   {
        $post = $this->post;
        $images = Image::get();
        $videos = Video::get();
        date_default_timezone_set('Africa/Casablanca');

        $userImage = '';
        $userName = '';
        $userId = '';
        $post->postImgs = array();
        $post->postVds = '';

        $user = User::where('id',$post->user_id)->first();
        $imagesArray = array();
        foreach($images as $image){
            if($post->id == $image->post_id && $image->type == "post"){
                array_push($imagesArray,$image->name);
            }
            if($user->id == $image->user_id && $image->type == "profile"){
                $userImage = $image->name;
                $userName = $user->name;
                $userId = $user->id;
            }
        }
        foreach($videos as $video){
            if($post->id == $video->post_id){
                $post->postVds = $video->name;
            }
        }
        $datetime1 = new DateTime($post->time);
        $datetime2 = new DateTime(date("Y-m-d H:i:s"));
        $interval = $datetime1->diff($datetime2);
        if((int)$interval->format('%y') > 0)
            $post->time = $interval->format('%y y');
        elseif((int)$interval->format('%m') > 0)
            $post->time = $interval->format('%m m');
        elseif((int)$interval->format('%d') > 0)
            $post->time = $interval->format('%d d');
        elseif((int)$interval->format('%h') > 0)
            $post->time = $interval->format('%h H');
        elseif((int)$interval->format('%i') > 0)
            $post->time = $interval->format('%i min');
        else
            $post->time = 'just Now';
        // array_push($time , $post->time);
        $post->userImg = $userImage;
        $post->userName = $userName;
        $post->userId = $userId;
        $post->postImgs = $imagesArray;
        
        $post->edit = false;

        return ["post" => $post];
   }
}
