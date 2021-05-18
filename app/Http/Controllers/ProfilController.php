<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use Auth;
use Hash;

class ProfilController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $user = auth()->user();
        $user->profileimg = Image::where('user_id',$user->id)->where('type','profile')->first('name');
        $user->coverimg = Image::where('user_id',$user->id)->where('type','cover')->first('name');
        return response()->json($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        }
        if($request->cover != "null"){
            $cover = Image::where('user_id',$user->id)->where('type','cover')->first();
            $image = $request->file('cover');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user/'.$user->id.'/cover'),$new_name);
            $cover->update(['name' => $user->id.'/cover/'. $new_name]);
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
