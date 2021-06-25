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
use App\Models\Friend;
use DateTime;
use App\Models\Notification;
use App\Models\PostSave;
use App\Models\Like;
use App\Models\PostShare; 
use App\Models\Comment;
use App\Models\story;

use DateTime as GlobalDateTime;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Array_;

class NewStoryEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


   
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('newStory');
    }


    public function broadcastWith()
    {
        $id = auth()->user()->id;
        date_default_timezone_set('Africa/Casablanca');
        $user = User::findOrFail($id);
        $user->img = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        $user->isActive = true;
        $stories = story::where('user_id',$id)->get();
        
        foreach ($stories as $value) {
            $image = Image::where('user_id',$user->id)->where('type','story')->where("storie_id",$value->id)->first('name');
            if($image){
                $value->image = 'stories/'.$id.'/'. $image->name;
            }else{
                $value->image = null;
            }
            }
            $last_stories = story::where('user_id',$id)->latest()->first();
    
        $datetime1 = new DateTime($last_stories->time);
        $datetime2 = new DateTime(date("Y-m-d H:i:s"));
        $interval = $datetime1->diff($datetime2);
        if((int)$interval->format('%y') > 0)
            $last_stories->time = $interval->format('%y y');
        elseif((int)$interval->format('%m') > 0)
            $last_stories->time = $interval->format('%m m');
        elseif((int)$interval->format('%d') > 0)
            $last_stories->time = $interval->format('%d d');
        elseif((int)$interval->format('%h') > 0)
            $last_stories->time = $interval->format('%h H');
        elseif((int)$interval->format('%i') > 0)
            $last_stories->time = $interval->format('%i min');
        else
            $last_stories->time = 'just Now';

        $user->time = $last_stories->time;

        $user->stories = $stories;
    
        return ['story' => $user];
        
    }

}
