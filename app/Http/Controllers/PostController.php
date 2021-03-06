<?php

namespace App\Http\Controllers;

use App\Events\likePostEvent;
use Illuminate\Http\Request;
use DateTime;
use App\Http\Controllers\format;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use App\Models\PostSave;
use App\Models\Like;
use App\Models\PostShare; 
use App\Models\Comment;
use Auth;
use DateTime as GlobalDateTime;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Array_;
use App\Events\NewPostEvent;
use App\Models\Friend;
use App\Events\NotificationEvent;
use App\Models\Notification;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    public function SinglePost(Request $request)
    {
        $post = Post::where('id',$request->post)->first();
        
        $post = $this->postget($post);
        $comments = Comment::where('post_id' , $post->id)->get();
        foreach ($comments as $comment) {
            $comment = $this->commentget($comment);
        }
        $post->comments = $comments;
        return response()->json($post);
    }

    public function postget($post)
    {        
        $images = Image::get();
        $videos = Video::get();
        date_default_timezone_set('Africa/Casablanca');

        $userImage = '';
        $userName = '';
        $userId = '';
        $post->postImgs = array();
        $post->postVds = '';
        $post->postLike = false;
        $post->postSave = false;
        $post->numbers = array();
        $post->fileUrl = null;

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
            if($post->type == 'cover_default'){
                if($user->id == $image->user_id && $image->type == "cover"){
                    $userCover = $image->name;
                }
            }else{
                $userCover = null;
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
        $post->userCover = $userCover;
        $post->userName = $userName;
        $post->userId = $userId;
        $post->postImgs = $imagesArray;
        if($post->userId == auth()->user()->id){
            $post->edit = true;
        }else{
            $post->edit = false;
        }

        if ($post->type == "create" || $post->type == "cover" || $post->type == "profile" || $post->type == "profile_default" || $post->type == "cover_default") {
            $post->edit = false;
        }

        
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

        $post->numbers = $this->get($post->id);

        return $post;
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

    public function index() 
    {
        $fr = $this->Friends(auth()->user()->id);
        $fr->add(auth()->user()->id);
        $posts = Post::whereIn('user_id',$fr)->orderBy('time', 'DESC')->get();
        //where('type','post')->
        foreach($posts as $post){
            //$this->postget($post);
           $post = $this->postget($post);
           $comments = Comment::where('post_id' , $post->id)->get();
           foreach ($comments as $comment) {
               $comment = $this->commentget($comment);
           }
           $post->comments = $comments;
        };

        return response()->json($posts);
    }

    public function UserPosts(Request $request) 
    {
        $id = $request->id;
        $posts = Post::where('user_id',$id)->orderBy('time', 'DESC')->get();
        //where('type','post')->
        foreach($posts as $post){
            //$this->postget($post);
           $post = $this->postget($post);
           $comments = Comment::where('post_id' , $post->id)->get();
           foreach ($comments as $comment) {
               $comment = $this->commentget($comment);
           }
           $post->comments = $comments;
        };

        return response()->json($posts);
    }

    public function Friends($id)
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
        $friends = User::whereIn('id',$new)->get('id');

        return $friends;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) 
    {
        $user = User::findOrFail(auth()->user()->id);
        date_default_timezone_set('Africa/Casablanca');
        if($request->Statu == ""){
            $request->Statu = " ";
        };
        if($request->Text == ""){
            $request->Text = " ";
        };
        $post = Post::create([
            'user_id' => $user->id,
            'type' => 'post',
            'statu' => $request->Statu,
            'text' => $request->Text,
            'time' => date("Y-m-d H:i:s"),
        ]);

        if($request->imagenbr > 0){
            $images= array();
            for ($i=0; $i < $request->imagenbr; $i++) { 
                array_push($images ,$request->Images[$i] );
            };
    
            foreach ($images as $image) {
                $new_name = 'postImg-'.rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/posts/'.$user->id),$new_name);
                Image::create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                    'name' => $new_name,
                    'type' => 'post', 
                ]);
            };
        };

        if($request->Video != "null"){
            $video = $request->Video;
    
            $new_name = 'postVd-'.rand() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('videos/posts/'.$user->id),$new_name);
            Video::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'name' => $new_name,
                'type' => 'post', 
            ]);
        };

        broadcast(new NewPostEvent($post));

        $post = $this->postget($post);
        $post->comments = array();

        return response()->json($post);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $post = Post::where('id',$request->id)->first();
        $post = $this->postget($post);
        $comments = Comment::where('post_id' , $post->id)->get();
        foreach ($comments as $comment) {
            $comment = $this->commentget($comment);
        }
        $post->comments = $comments;
        return response()->json($post);
    }

    public function saved()
    {
        $PostSave = PostSave::where('user_id',auth()->user()->id)->get('post_id');
        $posts = Post::whereIn('id',$PostSave)->get();
        foreach($posts as $post){
            $this->postget($post);
        }
        return response()->json($posts);
    }

    
    public function get($id)
    {
        $likes = Like::where('post_id',$id)->get();
        $shares = PostShare::where('post_id',$id)->get();
        $comments = Comment::where('post_id',$id)->get();
        $numbers = ['likes' => count($likes) , 'shares' => count($shares) , 'comments' => count($comments) ];
        return $numbers;
    }
    
    public function getNumbers(Request $request)
    {
        return response()->json($this->get($request->id));
    }
    // like

    public function like(Request $request)
    {
        if($request->etat){
            Like::where('user_id',auth()->user()->id)->where('post_id',$request->id)->delete();
        }else{
            Like::create([
                'post_id' => $request->id,
                'user_id' => auth()->user()->id,
            ]);
            $id_to = Post::where('id',$request->id)->first('user_id');
            $notif = Notification::where('user_id',$id_to->user_id)->where('user_from',auth()->user()->id)->where('type','like_post')->where('post_id',$request->id)->count();

            if (auth()->user()->id != $id_to->user_id && $notif == 0) {
                broadcast(new NotificationEvent($id_to->user_id,$request->id,'like_post'));
            }
        }
        broadcast(new likePostEvent($request->id , $request->etat));
        
        return response()->json($this->get($request->id)); 
    }

    public function save(Request $request)
    {
        if($request->etat){
            PostSave::where('user_id',auth()->user()->id)->where('post_id',$request->id)->delete();
        }else{
            PostSave::create([
                'post_id' => $request->id,
                'user_id' => auth()->user()->id,
            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = Post::findOrFail($request->id);
        date_default_timezone_set('Africa/Casablanca');
        if($request->Statu == ""){
            $request->Statu = " ";
        };
        if($request->Text == ""){
            $request->Text = " ";
        };
        $post->update([
            'type' => 'post',
            'statu' => $request->Statu,
            'text' => $request->Text,
        ]);
        $files= array();
        $oldimages= array();
        $images = Image::where('post_id',$request->id)->get('name');
        $video = Video::where('post_id',$request->id)->get('name');

        if($request->fileType == 'images'){
            if(count($video) > 0){
                unlink('videos/posts/'.auth()->user()->id.'/'.$video[0]->name);
                Video::where('post_id',$request->id)->delete();
            }
            
            for ($i=0; $i < $request->imgLength; $i++) { 
                array_push($oldimages ,$request->image[$i] );
            };
            
            foreach($images as $old){
                if(!in_array($old->name,$oldimages)){
                    Image::where('name',$old->name)->delete();
                    // echo $old->name;
                    unlink('images/posts/'.auth()->user()->id.'/'.$old->name);
                }
            }

          
            for ($i=0; $i < $request->fileLength; $i++) { 
                array_push($files ,$request->OurFile[$i] );
            };
            if(count($files) > 0){
                foreach ($files as $image) {
                    $new_name = 'postImg-'.rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/posts/'.auth()->user()->id),$new_name);
                    Image::create([
                        'post_id' => $post->id,
                        'user_id' => auth()->user()->id,
                        'name' => $new_name,
                        'type' => 'post', 
                    ]);
                };
            }
        }else if($request->fileType == 'video'){
           // Image::where('post_id',$request->id)->delete();
            foreach($images as $old){
                Image::where('name',$old->name)->delete();
                unlink('images/posts/'.auth()->user()->id.'/'.$old->name);
            }  
            if($request->video == ''){
                if(count($video) == 0){
                    $NewVideo = $request->OurFile[0];
                    $new_name = 'postVd-'.rand() . '.' . $NewVideo->getClientOriginalExtension();
                    $NewVideo->move(public_path('videos/posts/'.auth()->user()->id),$new_name);
                    Video::create([
                        'post_id' => $post->id,
                        'user_id' => auth()->user()->id,
                        'name' => $new_name,
                        'type' => 'post', 
                    ]);
                }else{
                    $NewVideo = $request->OurFile[0];
                    $new_name = 'postVd-'.rand() . '.' . $NewVideo->getClientOriginalExtension();
                    $NewVideo->move(public_path('videos/posts/'.auth()->user()->id),$new_name);
                    unlink('videos/posts/'.auth()->user()->id.'/'.$video->name);
                    $video->name = $new_name;
                    
                }
            }
        }else{
            foreach($images as $old){
                Image::where('name',$old->name)->delete();
                unlink('images/posts/'.auth()->user()->id.'/'.$old->name);
            }   
            if(count($video) > 0){
                unlink('videos/posts/'.auth()->user()->id.'/'.$video[0]->name);
                Video::where('post_id',$request->id)->delete();
            }     
          
        }
        /* dd($request->fileType); */
        return response()->json($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $images = Image::where('post_id',$request->id)->get('name');
        $video = Video::where('post_id',$request->id)->get('name');
        foreach($images as $old){
            if($old){
                unlink('images/posts/'.auth()->user()->id.'/'.$old->name);
            }
            Image::where('name',$old->name)->delete();
        }        
        if(count($video) >0){
            unlink('videos/posts/'.auth()->user()->id.'/'.$video[0]->name);
            Video::where('post_id',$request->id)->delete();
        }
        Like::where('post_id',$request->id)->delete();
        Comment::where('post_id',$request->id)->delete();
        PostSave::where('post_id',$request->id)->delete();
        PostShare::where('post_id',$request->id)->delete();
        Post::where('id',$request->id)->delete();
    }
}
