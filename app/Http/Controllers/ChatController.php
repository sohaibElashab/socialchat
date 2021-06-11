<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use App\Models\Friend;
use App\Models\Online;
use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\Message;
use App\Models\MessageRead;
use App\Models\MessageDelete;
use App\Events\SendTextEvent;

class ChatController extends Controller
{
    public function ChatList()
    {
        $id = auth()->user()->id;
        $chatsID = ChatUser::where('user_id',$id)->get('chat_id');
        $chatsSolo = Chat::whereIn('id',$chatsID)->where('type','solo')->get('id');
        //$friends = ChatUser::whereIn('chat_id',$chatsSolo)->where('user_id','!=',$id)->get('user_id');
        $List = collect();
        foreach ($chatsSolo as $c) {
                 $new = collect();
                $friend_id = ChatUser::where('chat_id',$c->id)->where('user_id','!=',$id)->first('user_id');
                $new->put("id",$friend_id->user_id);
                //if($this->userInfo($friend_id->user_id)){}
                    $new->put("imgUserChat","images/user/".$this->userInfo($friend_id->user_id)->profileimg->name);
                    $new->put("NameUserChat",$this->userInfo($friend_id->user_id)->name);
                
            
                $message = Message::where('chat_id',$c->id)->latest()->first();
                //if($message){}
                    
                    if($message->text != null){
                        $new->put("txtChat",$message->text);
                    }elseif ($message->image != null) {
                        $new->put("txtChat","Sent an image");
                    }elseif ($message->video != null) {
                        $new->put("txtChat","Sent a video");
                    }
                   /*  $new->put("imgChat",$message->image);
                    $new->put("vidChat",$message->video); */
                    $new->put("TimeSend",$message->time);
                
            
                $Allmessages = Message::where('chat_id',$c->id)->get('id');
                $number = MessageRead::whereIn('message_id',$Allmessages)->where('user_id',$id)->where('status',false)->count();
                $new->put("numberMsg",$number);
                if($this->MessageCount($c->id) > 0){
                    $List->add($new); 
                }
            }
        return response()->json($List);
    }

    public function MessageCount($id)
    {
        $user = auth()->user();
        $deleted = MessageDelete::where('user_id',$user->id)->get('message_id');
        $messages = Message::where('chat_id',$id)->whereNotIn('id',$deleted)->count();
        return $messages;
    }

    public function MessageNotdeleted($id)
    {
        $user = auth()->user();
        $deleted = MessageDelete::where('user_id',$user->id)->get('message_id');
        $messages = Message::where('chat_id',$id)->whereNotIn('id',$deleted)->get();
        $messagesID = Message::where("chat_id",$id)->whereNotIn('id',$deleted)->get('id');
        $read = MessageRead::whereIn("message_id",$messagesID)->update(['status' => true]);
        return $messages;
    }


    public function userInfo($id)
    {
        $user = User::where('id',$id)->first('name');
        if($user){
            $user->profileimg = Image::where('user_id',$id)->where('type','profile')->first('name');
        }
        return $user;
    }

    public function NewMessage(Request $request)
    {
        $img = null;
        $vid = null;
        $txt = null;
        $time = $request->time;
        $friendID = $request->id;
        $id = auth()->user()->id;
        if($request->image != "null"){
            //dd($request);
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/message/'.$id),$new_name);
            //$profile->update(['name' => $user->id.'/profile/'. $new_name]);
            $img = 'images/message/'.$id.'/'.$new_name;
        }
        if($request->video != "null"){
            $image = $request->file('video');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/message/'.$id),$new_name);
            //$profile->update(['name' => $user->id.'/profile/'. $new_name]);
            $vid = 'images/message/'.$id.'/'.$new_name;
        }
        if($request->text != "null"){
            $txt = $request->text;
        }
     
        $chatsID = ChatUser::where('user_id',$id)->get('chat_id');
        $chatsSolo = Chat::whereIn('id',$chatsID)->where('type','solo')->get('id');
        $friendChat = ChatUser::whereIn('chat_id',$chatsSolo)->where('user_id',$friendID)->first('chat_id');
        if($friendChat == null){
            $chat = Chat::create([
                'type' => 'solo',
                'name' => 'null',
                'picture' => 'null'
            ]);
            
            ChatUser::create([
                'chat_id' => $chat->id,
                'user_id' => $id
            ]);
            
            ChatUser::create([
                'chat_id' => $chat->id,
                'user_id' => $friendID
            ]);

            $message = Message::create([
                'chat_id' => $chat->id,
                'user_id' => $id,
                'text' => $txt,
                'image' => $img,
                'video' => $vid,
                'time' => $time,
            ]);
            
            MessageRead::create([
                'message_id' => $message->id,
                'user_id' => $friendID,
                'status' => false
            ]);

            broadcast(new SendTextEvent($message,$friendID));

            return response()->json($message);
        }else{

            $message = Message::create([
                'chat_id' => $friendChat->chat_id,
                'user_id' => $id,
                'text' => $txt,
                'image' => $img,
                'video' => $vid,
                'time' => $time,
            ]);
            
            MessageRead::create([
                'message_id' => $message->id,
                'user_id' => $friendID,
                'status' => false
            ]);

            broadcast(new SendTextEvent($message,$friendID));

            return response()->json($message); 
        }
    }

    public function LoadMessages(Request $request)
    {
        $id = auth()->user()->id;
        $friendID = $request->id;
        $chatsID = ChatUser::where('user_id',$id)->get('chat_id');
        if(count($chatsID) > 0){
            $chatsSolo = Chat::whereIn('id',$chatsID)->where('type','solo')->get('id');
            $chat = ChatUser::whereIn('chat_id',$chatsSolo)->where('user_id',$friendID)->first('chat_id');
    
            if($this->MessageCount($chat->chat_id) > 0){
                //$messages = Message::where("chat_id",$chat->chat_id)->get();
                $messages = $this->MessageNotdeleted($chat->chat_id);
        
                foreach ($messages as $message) {
                    $message->txtChat = $message->text;
                    $message->imgChat = $message->image;
                    $message->vidChat = $message->video;
                    $message->TimeSend = $message->time;
                    if($message->user_id == $id){
                        $image = Image::where('user_id',$id)->where('type','profile')->first('name');
                        $message->imgUserChat = "images/user/".$image->name;
                        $message->MsgFor = "";
                    }elseif ($message->user_id == $friendID) {
                        $image = Image::where('user_id',$friendID)->where('type','profile')->first('name');
                        $message->imgUserChat = "images/user/".$image->name;
                        $message->MsgFor = "chat-left";
                    }
                }
                return response()->json($messages);
            }else{
                $empty = array();
                return response()->json($empty);
            }
           
        }else{
            $empty = array();
            return response()->json($empty);
        }
       
    }

    public function UnreadMessages()
    {
        $id = auth()->user()->id;
        $deleted = MessageDelete::get('message_id');
        $messages = MessageRead::where("user_id",$id)->where("status",false)->whereNotIn('message_id',$deleted)->get('message_id');
        $countALL = MessageRead::where("user_id",$id)->where("status",false)->whereNotIn('message_id',$deleted)->count();
        $sender = Message::whereIn('id',$messages)->distinct()->get('user_id');
        $list = collect();
        foreach ($sender as  $s) {
            //$s->user_id
            $new = collect();
            $Allmsg = Message::where('user_id',$s->user_id)->get('id');
            $Unread = MessageRead::whereIn('message_id',$Allmsg)->where('user_id',$id)->where('status',false)->count();
            $new->put("count",$Unread);
            $new->put("id",$s->user_id);
            $image = Image::where('user_id',$s->user_id)->where('type','profile')->first('name');
            $name = User::where('id',$s->user_id)->first('name');
            $new->put("img","images/user/".$image->name);
            $new->put("name",$name->name);
            $list->add($new); 
        }
       

        return response()->json([$list,$countALL]);
        //return response()->json($sender);
    }

    public function DeleteChat(Request $request)
    {
        $id = $request->id;
        
        foreach ($request->messages as $message) {
            foreach ($message as $key => $value) {
                if($key == 'id'){
                    MessageDelete::create([
                        'message_id' => $value,
                        'user_id' => $id,
                    ]);
                     $this->ClearDB($value);
                }
            } 
        }//MessageDelete
        return response()->json();   
    }

    public function ClearDB($id)
    {
        $chatID = Message::where('id',$id)->first('chat_id');
       
        $Chatusers = ChatUser::where('chat_id',$chatID->chat_id)->count();
        $DeleteBy = MessageDelete::where('message_id',$id)->count();

        if($Chatusers == $DeleteBy){
             //delete files 
            $msg = Message::where('id',$id)->first();
            if($msg->image){
                unlink($msg->image);
            }
            if($msg->video){
                unlink($msg->video);
            }

            //delete messages
            Message::where('id',$id)->delete();
            MessageDelete::where('message_id',$id)->delete();
            MessageRead::where('message_id',$id)->delete();
            
            //delete chat
            $messageCount = Message::where('chat_id',$chatID->chat_id)->count();
            if($messageCount == 0){
                Chat::where('id',$chatID->chat_id)->delete();
                ChatUser::where('chat_id',$chatID->chat_id)->delete();
            }  
        }
    }


    public function Friends($id)
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
        $friends = User::whereIn('id',$new)->get('id');

        return $friends;
    }

    public function ChatSearch(Request $request)
    {
        $friends=$this->Friends(auth()->user()->id);
        $users = User::where('name','like','%'.$request->value.'%')->whereIn('id',$friends)->get();
        foreach ($users as  $user) {
            $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        }
        return response()->json($users);
    }

}
