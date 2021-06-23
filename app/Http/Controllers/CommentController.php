<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Image;
use App\Models\like;
use Illuminate\Http\Request;
use DateTime;
use App\Events\LikeCommentEvent;
use App\Events\CommentEvent;
use Auth;
use App\Events\SharePostEvent;
use App\Models\PostShare;
use App\Events\NotificationEvent;
use App\Models\Post;

class CommentController extends Controller
{

    public function SharePost(Request $request)
    {
        $share = PostShare::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id, 
        ]);

        broadcast(new SharePostEvent($request->post_id));
        
        $id_to = Post::where('id',$request->post_id)->first('user_id');
        if (auth()->user()->id != $id_to->user_id) {
            broadcast(new NotificationEvent($id_to->user_id,$request->post_id,'share'));
        }

        return response()->json($share);
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        date_default_timezone_set('Africa/Casablanca');

        $comment = Comment::create([
            'post_id' => $request->id,
            'user_id' => $userId,
            'text' => $request->text,
            'time' => date("Y-m-d H:i:s"),
        ]);
        
        broadcast(new CommentEvent($comment , true));

        $id_to = Post::where('id',$request->id)->first('user_id');
        if (auth()->user()->id != $id_to->user_id) {
            broadcast(new NotificationEvent($id_to->user_id,$request->id,'comment'));
        }
        return response()->json($this->commentget($comment)); 
    }

    public function like(Request $request)
    {
        if($request->etat){
            Like::where('user_id',auth()->user()->id)->where('comment_id',$request->id)->delete();
        }else{
            Like::create([
                'comment_id' => $request->id,
                'user_id' => auth()->user()->id,
            ]);

            $comment = Comment::where('id',$request->id)->first(['post_id','user_id']);
            if (auth()->user()->id != $comment->user_id) {
                broadcast(new NotificationEvent($comment->user_id,$comment->post_id,'like_comment'));
            }
        }
        
        $likes = Like::where('comment_id',$request->id)->count();
        broadcast(new LikeCommentEvent($request->id , $request->postId , $request->etat)); 
        return response()->json($likes); 
    }
    
    /**
     * get the numbers of liks, comment and share.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $comments = Comment::where('post_id' , $request->id)->get();
        foreach ($comments as $comment) {
            $comment = $this->commentget($comment);
        }
        return response()->json($comments); 
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $comment =Comment::where('id',$request->id)->first();
        broadcast(new CommentEvent($comment , false));
        $comment->delete();
        return response()->json($this->show($request)); 
    }
}
