<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\FriendRequest;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        $user->coverimg = Image::where('user_id',$user->id)->where('type','cover')->first('name');

        $from = auth()->user()->id;
        $to = $request->id;

        $Frequest = FriendRequest::where('user_from',$from)->where('user_to',$to)->first();
        if($Frequest){
            $user->message = "cancel";
        }

        $Frequest = FriendRequest::where('user_from',$to)->where('user_to',$from)->first();
        if($Frequest){
            $user->message = "accept";
        }

        return response()->json($user);
    }

    public function UserID(Request $request)
    {
        session(['UserID' => $request->id]);
        return response()->json();
        //$value = session('key');
    }

    public function ProfileSearch(Request $request)
    {
        $users = User::where('name','like','%'.$request->value.'%')->get();
        foreach ($users as  $user) {
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        }
        return response()->json($users);
    }

    public function SendRequest(Request $request)
    {
        $from = auth()->user()->id;
        $to = $request->id;

        $Frequest = FriendRequest::create([
            'user_from' => $from,
            'user_to' => $to,
            'status' => 'sent',
        ]); 

        return response()->json($Frequest);
    }



    public function DeleteRequest(Request $request)
    {
        $from = auth()->user()->id;
        $to = $request->id;
        $Frequest = FriendRequest::where('user_from',$from)->where('user_to',$to)->delete();
     
        return response()->json(); 
    }
    
    public function AcceptRequest(Request $request)
    {
        # code...
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
