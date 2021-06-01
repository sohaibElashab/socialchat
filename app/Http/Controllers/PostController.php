<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\datetime;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use Auth;
use DateTime as GlobalDateTime;
use PhpParser\Node\Expr\Cast\Array_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('type','post')->get();
        $images = Image::get();

        $userImage = '';
        $userName = '';
        $userId = '';
        foreach($posts as $post){
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
            $post->userImg = $userImage;
            $post->userName = $userName;
            $post->userId = $userId;
            $post->postImgs = $imagesArray;

            if($post->userId == auth()->user()->id){
                $post->edit = true;
            }else{
                $post->edit = false;
            }
        };

        return response()->json($posts);   

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
        // dd($request);
        // dd($request->Images);
        // print_r(str_split($request->Images, 4));

        // dd($request->Images);
        

        // foreach ($request->Images as $image) {
        //     dd($image);
        // }

        // $lwa = "9lwa";
        // dd($lwa);


        // echo($request->Images);
        $post = Post::create([
            'user_id' => $user->id,
            'type' => 'post',
            'statu' => $request->Statu,
            'text' => $request->Text,
            'time' => date("Y-m-d H:i:s"),
        ]);

        // $images = $request->file('Images');

        $images= array();
        for ($i=0; $i < $request->imagenbr; $i++) { 
            array_push($images ,$request->Images[$i] );
        };

        foreach ($images as $image) {
            $new_name = 'post'.rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/posts/'.$user->id),$new_name);
            Image::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'name' => $new_name,
                'type' => 'post', 
            ]);
            $post->images = $new_name;
        };

        // if($request->file('Images') != [] ){
        // }
        // if(empty($request->file('Videos'))){
        //     $video = $request->file('Videos');
        //     $new_name = rand() . '.' . $image->getClientOriginalExtension();
        //     $video->move(public_path('images/user/'.$user->id.'/posts/'.$post->id),$new_name);
        //     Video::create([
        //         'post_id' => $post->id,
        //         'user_id' => $user->id,
        //         'name' => $new_name,
        //         'type' => 'post', 
        //     ]);
        // }

        return response()->json($request->Images);   
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
