<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\FriendRequest;
use App\Models\Notification;
use DateTime;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LoadNotif()
    { 
        date_default_timezone_set('Africa/Casablanca');
        $id = auth()->user()->id;
        $notifications = Notification::where('user_id',$id)->orderBy('time', 'DESC')->get();
        foreach ($notifications as $notif) {
            $datetime1 = new DateTime($notif->time);
            $datetime2 = new DateTime(date("Y-m-d H:i:s"));
            $interval = $datetime1->diff($datetime2);
            if((int)$interval->format('%y') > 0)
                $notif->time = $interval->format('%y y');
            elseif((int)$interval->format('%m') > 0)
                $notif->time = $interval->format('%m m');
            elseif((int)$interval->format('%d') > 0)
                $notif->time = $interval->format('%d d');
            elseif((int)$interval->format('%h') > 0)
                $notif->time = $interval->format('%h H');
            elseif((int)$interval->format('%i') > 0)
                $notif->time = $interval->format('%i min');
            else
                $notif->time = 'just Now';

            if($notif->type == 'post'){
                $notif->WhatDo = "Posted in his profile";
            }elseif ($notif->type == 'like_post') {
                $notif->WhatDo = "Liked your Post";
            }elseif ($notif->type == 'like_comment') {
                $notif->WhatDo = "Liked your Comment";
            }elseif ($notif->type == 'comment') {
                $notif->WhatDo = "Commented on your post";
            }elseif ($notif->type == 'request') {
                $notif->WhatDo = "Sent a Friend Request";
            }elseif ($notif->type == 'share') {
                $notif->WhatDo = "Shared Your Post";
            }

            $user = User::where('id',$notif->user_from)->first(['id','name']);
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');

            $notif->userImg = 'images/user/'.$user->profileimg->name;
            $notif->userName = $user->name;
            $notif->userId = $user->id;
        }

        return response()->json($notifications);

    }

    public function DeleteNotif(Request $request)
    {
        Notification::where('id',$request->id)->delete();
        return response()->json();
    }

}
