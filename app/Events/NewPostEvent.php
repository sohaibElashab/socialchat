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

        
        $save = PostSave::where('post_id',$post->id)->where('user_id',auth()->user()->id)->get();
        $like = Like::where('post_id',$post->id)->where('user_id',auth()->user()->id)->get();
        $Comment = Comment::where('post_id',$post->id)->where('user_id',auth()->user()->id)->get();
        if(count($save) > 0){
            $post->postSave = true;
        } 
        if(count($like) > 0){
            $post->postLike = true;
        }
        if(count($Comment) > 0){
            $post->postComment = true;
        }

        $comments = Comment::where('post_id' , $post->id)->get();
        foreach ($comments as $comment) {
            $comment = $this->commentget($comment);
        }

        $post->comments = $comments;

        $post->numbers = $this->get($post->id);
        /* notification */
        $friendsList = $this->Getfriends($post->user_id);
        foreach ($friendsList as $value) {
            $notif = Notification::create([
                'user_id' => $value->id,
                'user_from' => auth()->user()->id,
                'post_id' => $post->id,
                'type' => "post",
                'time' => date("Y-m-d H:i:s")
            ]);
        }

        return ["post" => $post];
   }

   public function commentget($comment)
   {        
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

       if($comment->userId == auth()->user()->id){
           $comment->edit = true;
       }else{
           $comment->edit = false;
       }

       $like = Like::where('comment_id',$comment->id)->where('user_id',auth()->user()->id)->get();
       if(count($like) > 0){
           $comment->commentLike = true;
       }

       return $comment;
   }

  public function get($id)
   {
       $likes = Like::where('post_id',$id)->get();
       $shares = PostShare::where('post_id',$id)->get();
       $comments = Comment::where('post_id',$id)->get();
       $numbers = ['likes' => count($likes) , 'shares' => count($shares) , 'comments' => count($comments) ];
       return $numbers;
   }

  public function Getfriends($id)
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

      return $friends;
  }
}
