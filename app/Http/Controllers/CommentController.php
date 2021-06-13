<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostSave;
use App\Models\PostLike;
use App\Models\PostShare;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
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
        //
    }

    /**
     * get the numbers of liks, comment and share.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $likes = PostLike::where('post_id',$id)->get();
        $shares = PostShare::where('post_id',$id)->get();
        $comments = Comment::where('post_id',$id)->get();
        $numbers = ['likes' => count($likes) , 'shares' => count($shares) , 'comments' => count($comments) ];
        return $numbers;
    }
    public function getNumbers(Request $request)
    {
        return response()->json($this->get($request->id));
    }

    public function check(Request $request)
    {
        $postsave = PostSave::where('post_id',$request->id)->where('user_id',auth()->user()->id)->get();
        $postlike = PostLike::where('post_id',$request->id)->where('user_id',auth()->user()->id)->get();
        $save = false;
        $like = false;
        if(count($postsave) > 0){
            $save = true;
        }
        if(count($postlike) > 0){
            $like = true;
        }

        $checked = ['save' => $save , 'like' => $like];

        return response()->json($checked);
    }

    // like

    public function like(Request $request)
    {
        PostLike::create([
            'post_id' => $request->id,
            'user_id' => auth()->user()->id,
        ]);
        return response()->json($this->get($request->id));
    }
    public function unlike(Request $request)
    {
        PostLike::where('user_id',auth()->user()->id)->where('post_id',$request->id)->delete();
        return response()->json($this->get($request->id));
    }

    // save

    public function save(Request $request)
    {
        PostSave::create([
            'post_id' => $request->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function unsave(Request $request)
    {
        PostSave::where('user_id',auth()->user()->id)->where('post_id',$request->id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
