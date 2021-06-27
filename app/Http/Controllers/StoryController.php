<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\story;
use App\Models\User;
use App\Models\Friend;
use App\Models\StorySeen;
use DateTime;
use Illuminate\Http\Request;
use App\Events\NewStoryEvent;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->DeleteStories();
        $fr = $this->Friends(auth()->user()->id);
        $fr->add(auth()->user()->id);
        $new = collect();
        foreach ($fr as $id) {
            if($this->GetStories($id) != null){
                $new->add($this->GetStories($id));
            }
        }
        return response()->json($new);
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
        //$friends = User::whereIn('id',$new)->get('id');

        return $new;
    }

    public function GetStories($id)
    {
        date_default_timezone_set('Africa/Casablanca');
        $user = User::findOrFail($id);
        $user->img = Image::where('user_id',$user->id)->where('type','profile')->first('name');
       
        $stories = story::where('user_id',$id)->get();
        if(count($stories) > 0 ){
            foreach ($stories as $value) {
                $image = Image::where('user_id',$user->id)->where('type','story')->where("storie_id",$value->id)->first('name');
                if($image){
                    $value->image = 'stories/'.$id.'/'. $image->name;
                }else{
                    $value->image = null;
                }
            }
            $last_stories = story::where('user_id',$id)->latest()->first();
    
            $datetime1 = new DateTime($last_stories->time);
            $datetime2 = new DateTime(date("Y-m-d H:i:s"));
            $interval = $datetime1->diff($datetime2);
            if((int)$interval->format('%y') > 0)
                $last_stories->time = $interval->format('%y y');
            elseif((int)$interval->format('%m') > 0)
                $last_stories->time = $interval->format('%m m');
            elseif((int)$interval->format('%d') > 0)
                $last_stories->time = $interval->format('%d d');
            elseif((int)$interval->format('%h') > 0)
                $last_stories->time = $interval->format('%h H');
            elseif((int)$interval->format('%i') > 0)
                $last_stories->time = $interval->format('%i min');
            else
                $last_stories->time = 'just Now';
    
            $user->time = $last_stories->time;
    
            $user->stories = $stories;

            $storiesIDs = story::where('user_id',$id)->get('id');

            $countSeen = StorySeen::whereIn('story_id',$storiesIDs)->where('user_id',auth()->user()->id)->where('status',false)->count();

            if($countSeen > 0){
                $user->isActive = true;
            }else{
                $user->isActive = false;
            }

            return $user;
        }else{
            return null;
        }
       

    }

    public function create(Request $request)
    {
        
        $user = User::findOrFail(auth()->user()->id);
        date_default_timezone_set('Africa/Casablanca');

        $story = story::create([
            'user_id' => $user->id,
            'text' => $request->text,
            'Background' => $request->Background,
            'Font' => $request->Font,
            'time' => date("Y-m-d H:i:s"), 
        ]);

        $fr = $this->Friends(auth()->user()->id);
        $fr->add(auth()->user()->id);

        foreach ($fr as $id) {
            StorySeen::create([
                'story_id' => $story->id,
                'user_id' => $id,
                'status' => false,
            ]);
        }
       
        if ($request->file != "null") {
            $image = $request->file;
            $new_name = 'StoryImg-'.rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('stories/'.$user->id),$new_name);
            Image::create([
                'storie_id' => $story->id,
                'user_id' => $user->id,
                'name' => $new_name,
                'type' => 'story', 
            ]);
        }

        broadcast(new NewStoryEvent());
        return response()->json($this->GetStories(auth()->user()->id));
    }

    public function StorySee(Request $request)
    {
        $user_id = $request->user_id;
        $current_user = auth()->user()->id;
        $stories = story::where('user_id',$user_id)->get();
        foreach ($stories as $value) {
            $s = StorySeen::where('story_id',$value->id)->where('user_id',$current_user)->update(['status' => true]);
        }

        return response()->json();
    }

    public function DeleteStories()
    {
        date_default_timezone_set('Africa/Casablanca');
        $all = story::get();
        foreach ($all as $value) {
            $datetime1 = new DateTime($value->time);
            $datetime2 = new DateTime(date("Y-m-d H:i:s"));
            $interval = $datetime1->diff($datetime2);
            if((int)$interval->format('%d') > 0){
                story::where('id',$value->id)->delete();
            }
        }
    }
}
