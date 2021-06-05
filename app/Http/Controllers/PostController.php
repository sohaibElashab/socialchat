<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Http\Controllers\format;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use Auth;
use DateTime as GlobalDateTime;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Array_;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('type','post')->orderBy('time', 'DESC')->get();
        $images = Image::get();
        $videos = Video::get();
        date_default_timezone_set('Africa/Casablanca');

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

        if($request->Viedos != null){
            $video = $request->Viedos;
    
            $new_name = 'postVd-'.rand() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('videos/posts/'.$user->id),$new_name);
            Video::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'name' => $new_name,
                'type' => 'post', 
            ]);
        }

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
    public function show(Request $request)
    {
        
        $post = Post::where('id',$request->id)->first();
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
        if($post->userId == auth()->user()->id){
            $post->edit = true;
        }else{
            $post->edit = false;
        };

        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // $user = User::findOrFail($request->id);
        // $post = Post::findOrFail($request->id);
        $images = Image::where('post_id',$request->id)->get();
        // date_default_timezone_set('Africa/Casablanca');
        // if($request->Statu == ""){
        //     $request->Statu = " ";
        // };
        // if($request->Text == ""){
        //     $request->Text = " ";
        // };
        // $post->update([
        //     'type' => 'post',
        //     'statu' => $request->Statu,
        //     'text' => $request->Text,
        // ]);

        $oldimages= array();
        for ($i=0; $i < $request->imgLength; $i++) { 
            array_push($oldimages ,$request->image[$i] );
        };

        $data = array(); 
        if(count($images)>0){
            foreach($images as $image){
                $delete = false;
                foreach($oldimages as $oldImg){
                    if($oldImg == $image->name){
                        // array_push($arr , $image->name);
                        $delete = true;
                    }
                }
                if($delete == false){ 
                    $res=Image::find($image->id)->delete();
                    if ($res){
                        $data=[
                        'status'=>'1',
                        'msg'=>'success'
                    ];
                    }else{
                        $data=[
                        'status'=>'0',
                        'msg'=>'fail'
                    ];}
                }
            }
        }

        // if($request->fileLength > 0){
        //     $images= array();
        //     for ($i=0; $i < $request->imagenbr; $i++) { 
        //         array_push($images ,$request->Images[$i] );
        //     };
    
        //     foreach ($images as $image) {
        //         $new_name = 'postImg-'.rand() . '.' . $image->getClientOriginalExtension();
        //         $image->move(public_path('images/posts/'.$user->id),$new_name);
        //         Image::create([
        //             'post_id' => $post->id,
        //             'user_id' => $user->id,
        //             'name' => $new_name,
        //             'type' => 'post', 
        //         ]);
        //     };
        // };

        // if($request->Viedos != null){
        //     $video = $request->Viedos;
    
        //     $new_name = 'postVd-'.rand() . '.' . $video->getClientOriginalExtension();
        //     $video->move(public_path('videos/posts/'.$user->id),$new_name);
        //     Video::create([
        //         'post_id' => $post->id,
        //         'user_id' => $user->id,
        //         'name' => $new_name,
        //         'type' => 'post', 
        //     ]);
        // }

        return response()->json($data);
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
