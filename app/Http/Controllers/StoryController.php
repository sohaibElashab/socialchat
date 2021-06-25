<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\story;
use App\Models\User;
use Illuminate\Http\Request;

class StoryController extends Controller
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
        date_default_timezone_set('Africa/Casablanca');

        $story = story::create([
            'user_id' => $user->id,
            'text' => $request->text,
            'Background' => $request->Background,
            'Font' => $request->Font,
            'time' => date("Y-m-d H:i:s"),
        ]);
        
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

        return response()->json($story);
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
