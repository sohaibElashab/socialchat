<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use Auth;
use Hash;
use App\Mail\Forgot;
use App\Mail\Verify;
use Illuminate\Support\Facades\Mail;


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
