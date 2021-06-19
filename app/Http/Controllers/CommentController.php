<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use DateTime;
use Auth;

class CommentController extends Controller
{
    public function commentget($comment)
    {        
        date_default_timezone_set('Africa/Casablanca');        
        $user = User::where('id',$comment->user_id)->first();
        $comment->userId = $user->id;
        $comment->userImg = Image::where("user_id" , $user->id)->where("type" , "profile")->first('name');
        $comment->userName = $user->name;

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
            'image' => "null",
            'video' => "null",
            'reply' => 1,
            'org_comment' => 1,
            'time' => date("Y-m-d H:i:s"),
        ]);
        
        return response()->json($this->commentget($comment)); 
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
    public function destroy($id)
    {
        //
    }
}
