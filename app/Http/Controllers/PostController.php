<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use Auth;

class PostController extends Controller
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
    public function create(Request $request) 
    {
        $user = User::findOrFail(auth()->user()->id);

        $post = Post::create([
            'user_id' => $user->id,
            'type' => 'post',
            'statu' => $request->Statu,
            'text' => $request->Text,
            'time' => getdate(),
            // 'time' => date("h:i:sa"),
        ]);

        if(empty($request->file('Images'))){
            foreach ($request->file('Images') as $image) {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/user/'.$user->id.'/posts/'.$post->id),$new_name);
                Image::create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                    'name' => $new_name,
                    'type' => 'post', 
                ]);
            }
        }
        if(empty($request->file('Videos'))){
            $video = $request->file('Videos');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $video->move(public_path('images/user/'.$user->id.'/posts/'.$post->id),$new_name);
            Video::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'name' => $new_name,
                'type' => 'post', 
            ]);
        }

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
