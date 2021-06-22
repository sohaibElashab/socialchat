<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\Forgot;
use App\Mail\Verify;
use Illuminate\Support\Facades\Mail;
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Events\OfflineFriendEvent;
use App\Models\Online; 
use App\Models\Post;
use App\Events\NewPostEvent;
use App\Models\Comment;
use App\Models\like;
use App\Models\PostShare;

class ProfilController extends Controller
{ 
    
    public function LogoutUser()
    {
        if(auth()->user()){
            broadcast(new OfflineFriendEvent(auth()->user()));
            $log = Online::where('user_id',auth()->user()->id)->delete();
            Auth::logout();
        } 
    }

    public function OnlineUsers()
    {
       $o = Online::get();
       return response()->json($o);
    }

    public function index() 
    {
        $user = auth()->user(); 
        $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        $user->coverimg = Image::where('user_id',$user->id)->where('type','cover')->first('name');
        $user->name = ucfirst(strtolower($user->name));
        return response()->json($user);
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

    public function UserProfile(Request $request) 
    {
        if($request->id == auth()->user()->id){
            $user = auth()->user();
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
            $user->coverimg = Image::where('user_id',$user->id)->where('type','cover')->first('name');
            $user->status = "current";
            $user->message = "current";
            $user->FriendCount = count($this->Getfriends(auth()->user()->id));
            $user->PostCount = Post::where('user_id',auth()->user()->id)->count();
            return response()->json($user);
        }else{
            $user = User::where('id',$request->id)->first();
            $user->FriendCount = count($this->Getfriends($user->id));
            $user->PostCount = Post::where('user_id',$user->id)->count();
            $friends = $this->Getfriends(auth()->user()->id);
            if($friends->contains($user)){
                $user->message = "friend";
            } 


            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
            $user->coverimg = Image::where('user_id',$user->id)->where('type','cover')->first('name');
            $from = auth()->user()->id;
            $to = $request->id;

            $Frequest = FriendRequest::where('user_from',$from)->where('user_to',$to)->where('status','sent')->first();
            if($Frequest){
                $user->message = "cancel";
            }

            $Frequest = FriendRequest::where('user_from',$to)->where('user_to',$from)->where('status','sent')->first();
            if($Frequest){
                $user->message = "accept";
            }

            $user->status = "friend"; 

            return response()->json($user);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'birthdate' => 'required',
            'mobile' => 'required',
            'language' => 'required',
            'interested' => 'required',
            'adress' => 'required',
            'about' => 'required',
        ]); 

        $user = User::findOrFail(auth()->user()->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'adress' => $request->adress,
            'website' => $request->website,
            'birth_date' => $request->birthdate, 
            'gender' => $request->gender,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube, 
            'linkedin' => $request->linkedin, 
            'about' => $request->about,
            'quote' => $request->quote,
            'interested' => $request->interested,
            'language' => $request->language,
        ]);

        if($request->profile != "null"){
            $profile = Image::where('user_id',$user->id)->where('type','profile')->first();
            $image = $request->file('profile');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user/'.$user->id.'/profile'),$new_name);
            $profile->update(['name' => $user->id.'/profile/'. $new_name]);
            $user->profile = $profile->name;
            $post = Post::create([
                'user_id' => $user->id,
                'type' => 'profile',
                'statu' => "Changed profile picture",
                'text' => "",
                'time' => date("Y-m-d H:i:s"),
            ]);
            Image::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'name' => $profile->name,
                'type' => 'profile', 
            ]); 
            broadcast(new NewPostEvent($post)); 
        }
        if($request->cover != "null"){
            $cover = Image::where('user_id',$user->id)->where('type','cover')->first();
            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user/'.$user->id.'/cover'),$new_name);
            $cover->update(['name' => $user->id.'/cover/'. $new_name]);
            $post = Post::create([
                'user_id' => $user->id,
                'type' => 'cover',
                'statu' => "Changed cover picture",
                'text' => "",
                'time' => date("Y-m-d H:i:s"),
            ]);
            Image::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'name' => $cover->name,
                'type' => 'cover', 
            ]); 
            broadcast(new NewPostEvent($post));
        }

        return response()->json($user);    
    }


    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if (Hash::check($request->current_password,Auth::user()->password)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $res = "changed";
            return response()->json($res);
        }else {
            $res = "wrong password";
            return response()->json($res);
        }
        
    }


    public function ForgotPass(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $check = User::where('email',$request->email)->first();
        session(['currentEmail' => $request->email]);
        if($check != null){
            $newmail =  Hash::make($request->email);
            Mail::to($request->email)->send(new Forgot($newmail));
            $message ="An email has been sent to your adress";
            session(['key' => $newmail]);
            
            return response()->json($message);
        }else{
            $message="Invalid email";
            return response()->json($message);
        }
    }

    
    public function GatHashed()
    {
       // session()->flush();
        $value = session('key');
        return response()->json($value);
    }

    public function ResetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);
        $email = session('currentEmail');
        $user = User::where('email',$email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flush();
        $a = User::where('id',$user->id)->first();
        Auth::login($a);
        return response()->json($a); 
    }

    public function BeforeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'mobile' => 'required|min:10|max:10',
            'birthdate' => 'required',
            'gender' => 'required'
        ]);

        $userInfo = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'mobile' => $request->mobile,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
        );

        session(['userInfo' => $userInfo]);

        return response()->json($userInfo);

    }

    public function verify()
    {
        $em = session('userInfo');
        $pp = rand(11111111,99999999);
        Mail::to($em['email'])->send(new Verify($pp));

        return response()->json([$pp,$em]);
    }

    public function thisFiles($Paths)
    {
        foreach ($Paths as $path) {
            $path->NbrJaime = like::where('post_id',$path->post_id)->count();
            $path->NbrComment = Comment::where('post_id',$path->post_id)->count();
            $path->NbrPartage = PostShare::where('post_id',$path->post_id)->count();
        }
    }
    public function GetImages()
    {
        $userId = auth()->user()->id;
        $Paths = Image::where('user_id',$userId)->get();
        $this->thisFiles($Paths);
        return response()->json($Paths); 
    }
    public function GetVideos()
    {
        $userId = auth()->user()->id;
        $Paths = Video::where('user_id',$userId)->get();
        $this->thisFiles($Paths);
        return response()->json($Paths); 
    }

    public function GetImagesProfile(Request $request) 
    {
        $userId = $request->id;
        $Paths = Image::where('user_id',$userId)->get();
        $this->thisFiles($Paths);
        return response()->json($Paths); 
    }

}
