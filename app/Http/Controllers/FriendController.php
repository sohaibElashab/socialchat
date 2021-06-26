<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\FriendRequest;
use App\Models\Friend;
use Illuminate\Support\Facades\DB;
use App\Events\SendRequestEvent;
use App\Events\CancelRequestEvent;
use App\Events\AcceptRequestEvent;
use App\Events\AcceptRequestEvent2;
use App\Events\NotificationEvent;
use App\Models\Notification;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ProfileSearch(Request $request)
    {
        $users = User::where('name','like','%'.$request->value.'%')->get();
        foreach ($users as  $user) {
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        }
        return response()->json($users);
    }

    public function LoadRequests()
    {
        $id=auth()->user()->id;

        $users = DB::table('users')
                ->join('friend_requests','users.id','=','friend_requests.user_from')
                ->where('friend_requests.user_to',$id)
                ->where('friend_requests.status','sent')
                ->select('users.id','users.name')
                ->orderBy('friend_requests.updated_at', 'DESC')
                ->get();

        foreach ($users as  $user) {
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
            $user->FriendCount = $this->FriendCount($user->id);
        }
        return response()->json($users);
    }

    public function SendRequest(Request $request)
    {
        $from = auth()->user()->id;
        $to = $request->id;
        $req = $Frequest = FriendRequest::where('user_from',$from)->where('user_to',$to)->first();

        if($req == null){
            $Frequest = FriendRequest::create([
            'user_from' => $from,
            'user_to' => $to,
            'status' => 'sent',
            ]); 

            broadcast(new SendRequestEvent($Frequest));
            $notif = Notification::where('user_id',$Frequest->user_to)->where('user_from',$from)->where('type','request')->count();
            if($notif == 0){
                broadcast(new NotificationEvent($Frequest->user_to,null,'request'));
            }

            return response()->json($Frequest);
        }
    }

    public function DeleteRequest(Request $request)
    {
        
        $from = auth()->user()->id;
        $to = $request->id;
        $req = FriendRequest::where('user_from',$from)->where('user_to',$to)->first();
        broadcast(new CancelRequestEvent($req));
        $req->delete();
        //$Frequest = FriendRequest::where('user_from',$from)->where('user_to',$to)->delete();
        return response()->json(); 
    }
 
    public function DeleteReq(Request $request)
    {
        $from = auth()->user()->id;
        $to = $request->id;
        $req = FriendRequest::where('user_from',$to)->where('user_to',$from)->first();
        broadcast(new CancelRequestEvent($req));
        $req->delete();
        // $Frequest = FriendRequest::where('user_from',$to)->where('user_to',$from)->delete();
        
        return response()->json(); 
    }
    
    public function AcceptRequest(Request $request)
    {
        $user_id = auth()->user()->id;
        $friend_id = $request->id;

        $friend=Friend::create([
            'user_id' => $user_id,
            'friend_id' => $friend_id
        ]);
            //update in original project
        $Frequest = FriendRequest::where('user_from',$friend_id)->where('user_to',$user_id)->first();
        $Frequest->status = "accepted";
        $Frequest->save();
        broadcast(new AcceptRequestEvent($Frequest));
        broadcast(new AcceptRequestEvent2($Frequest));

        return response()->json($friend);
    }

    public function RemoveFriend(Request $request)
    {
        $id = $request->id;
        $friend = Friend::where(function($q) use ($id){
            $q->where('user_id',auth()->id());
            $q->where('friend_id',$id);
        })->orWhere(function($q) use ($id) {
            $q->where('friend_id',auth()->id());
            $q->where('user_id',$id);
        })->delete(); 
        
        $req = FriendRequest::where(function($q) use ($id){
            $q->where('user_from',auth()->id());
            $q->where('user_to',$id);
        })->orWhere(function($q) use ($id) {
            $q->where('user_to',auth()->id());
            $q->where('user_from',$id);
        })->delete(); 
        
        return response()->json();
    }

    public function LoadFriends(Request $request)
    {
        if($request->id == null){ 
            $id = auth()->id();
        }else{
            $id = $request->id;
        }
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

        foreach ($friends as  $user) {
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
            $user->coverimg = Image::where('user_id',$user->id)->where('type','cover')->first('name');
            $user->FriendCount = $this->FriendCount($user->id);
            $user->statu = "status-offline";
            $user->time = "Offline";
        }

        $authID = auth()->user()->id;

        $authFriends = $this->Getfriends($authID);
        $From = $this->ReqFrom();
        $To = $this->ReqTo();

        foreach ($friends as $f) {
            if($authFriends->contains($f)){
                $f->button = "remove";
            }else{
                $f->button = "add";
            }
            if($From->contains('user_from',$f->id)){
                $f->button = "accept";
            }
            if($To->contains('user_to',$f->id)){
                $f->button = "cancel";
            }

        }

        return response()->json($friends);
    }

    public function ReqTo()
    {
        $id = auth()->user()->id;
        return FriendRequest::where('user_from',$id)->where('status','sent')->get('user_to');
    }
    
    public function ReqFrom()
    {
        $id = auth()->user()->id;
        return FriendRequest::where('user_to',$id)->where('status','sent')->get('user_from');
    }


    public function FriendCount($id)
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

        return $friends->count();
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
        foreach ($friends as  $user) {
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
            $user->coverimg = Image::where('user_id',$user->id)->where('type','cover')->first('name');
            $user->FriendCount = $this->FriendCount($user->id);
            $user->statu = "status-offline";
            $user->time = "Offline";
        }

        return $friends;
    }

    public function YouMayKnow()
    {
        $id = auth()->user()->id;
        $reqs = DB::table('users')
                ->join('friend_requests','users.id','=','friend_requests.user_from')
                ->where('friend_requests.user_to',$id)
                ->where('friend_requests.status','sent')
                ->select('users.id')
                ->orderBy('friend_requests.updated_at', 'DESC')
                ->get();

        $friends = Friend::where('user_id',$id)->orWhere('friend_id',$id)->get();
        $new = collect();

        foreach ($reqs as  $value) {
            $new->add($value->id);
        }
        foreach ($friends as $key => $friend) {
            if($friend->user_id != $id){
                $new->add($friend->user_id);
            } elseif ($friend->friend_id != $id) {
                $new->add($friend->friend_id);
            }
        }
        $new = $new->unique();
        $new->add(auth()->user()->id);
        $friends = User::whereNotIn('id',$new)->get();

        foreach ($friends as  $user) {
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
            $user->FriendCount = $this->FriendCount($user->id);
            $Frequest = FriendRequest::where('user_from',auth()->user()->id)->where('user_to',$user->id)->where('status','sent')->first();
            if($Frequest){
                $user->message = "cancel";
            }else{
                $user->message = "add";
            }
        }
        
        return response()->json($friends);
    }

    public function FriendsInCommon(Request $request)
    {
        $authID = auth()->user()->id;
        $userID = $request->id;

        $authFriends = $this->Getfriends($authID);
        $userFriends = $this->Getfriends($userID);

        $common = collect();
        $other = collect();

        foreach ($userFriends as $friend) {
            if($authFriends->contains($friend)){
                $common->add($friend);
            }else{
                $other->add($friend);
            }
        }

        $From = $this->ReqFrom();
        $To = $this->ReqTo();

        foreach ($other as $o) {
            if($From->contains('user_from',$o->id)){
                $o->button = "accept";
            }
            if($To->contains('user_to',$o->id)){
                $o->button = "cancel";
            }
        }

        return response()->json([$common,$other]);
    }


}
