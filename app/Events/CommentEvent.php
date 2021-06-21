<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Comment;
use App\Models\User;
use App\Models\Image;
use App\Models\like;
use DateTime;

use DateTime as GlobalDateTime;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Array_;

class CommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    // public $id;
    // public $idPost;
    public $etat;
    public $comment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment , $etat)
    {
        $this->comment = $comment;
        $this->etat = $etat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Comment.'.$this->comment->post_id);
    }

    public function broadcastWith()
    {   
        $comment = $this->comment;
        if($this->etat){
            date_default_timezone_set('Africa/Casablanca');        
            $user = User::where('id',$comment->user_id)->first();
            $comment->userId = $user->id;
            $comment->userImg = Image::where("user_id" , $user->id)->where("type" , "profile")->first('name');
            $comment->userName = $user->name;
            $comment->commentLike = false;
            $comment->likes = Like::where('comment_id',$comment->id)->count();
    
            $datetime1 = new DateTime($comment->time);
            $datetime2 = new DateTime(date("Y-m-d H:i:s"));
            $interval = $datetime1->diff($datetime2);
            if((int)$interval->format('%y') > 0)
                $comment->time = $interval->format('%y y');
            elseif((int)$interval->format('%m') > 0)
                $comment->time = $interval->format('%m m');
            elseif((int)$interval->format('%d') > 0)
                $comment->time = $interval->format('%d d');
            elseif((int)$interval->format('%h') > 0)
                $comment->time = $interval->format('%h H');
            elseif((int)$interval->format('%i') > 0)
                $comment->time = $interval->format('%i min');
            else
                $comment->time = 'just Now';
    
            // if($comment->userId == auth()->user()->id){
            //     $comment->edit = true;
            // }else{
            // }
            $comment->edit = false;
    
            $like = Like::where('comment_id',$comment->id)->where('user_id',auth()->user()->id)->get();
            if(count($like) > 0){
                $comment->commentLike = true;
            }
        }

        return ['comment' => $comment , 'etat' => $this->etat];
    }


}
