<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Image;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Events\OnlineFriendEvent;
use App\Models\Online;
use App\Models\Post;

class RegisterController extends Controller 
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'mobile' => ['required', 'string', 'min:10' , 'max:10'],
            'birthdate' => ['required'],
            'gender' => ['required'],
        ]);//, 'confirmed' 
    } 

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        date_default_timezone_set('Africa/Casablanca');
        $user = User::create([
            'name' => $data['name'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' => $data['mobile'],
            'birth_date' => $data['birthdate'],
            'gender' => $data['gender'],
        ]);
        $date = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s',time() + 1);
        $date3 = date('Y-m-d H:i:s',time() + 2);
        $post = Post::create([
                'user_id' => $user->id,
                'type' => 'create',
                'statu' => "Created account",
                'text' => $user->name." has created a new SocialChat account.",
                'time' => $date,
            ]);
        $postC = Post::create([
                'user_id' => $user->id,
                'type' => 'cover_default',
                'statu' => "Changed cover picture",
                'text' => "",
                'time' => $date2,
            ]);
        $postP = Post::create([
                'user_id' => $user->id,
                'type' => 'profile_default',
                'statu' => "Changed profile picture",
                'text' => "",
                'time' => $date3,
            ]);
           
        $BGpics = array("bg1.jpg","bg2.jpg","bg3.jpg","bg4.jpg","bg5.jpg","bg6.jpg","bg7.jpg","bg8.jpg","bg9.jpg");
        $Bpic = array_rand($BGpics,1);
        Image::create([
            'post_id' => $postC->id,
            'user_id' => $user->id,
            'name' => 'BG/'.$BGpics[$Bpic],
            'type' => 'cover', 
        ]); 
        Image::create([
            'post_id' => $postC->id,
            'user_id' => $user->id,
            'name' => 'BG/'.$BGpics[$Bpic],
            'type' => 'post', 
        ]); 

       if ($data['gender'] == 'female') {
           $femalePics = array("female1.jpg","female2.jpg","female3.jpg","female4.jpg","female5.jpg","female6.jpg","female7.jpg","female8.jpg");
           $Fpic = array_rand($femalePics,1);
           Image::create([
               'post_id' => $postP->id,
               'user_id' => $user->id,
               'name' => 'FemalePic/'.$femalePics[$Fpic],
               'type' => 'profile',
           ]);
           Image::create([
               'post_id' => $postP->id,
               'user_id' => $user->id,
               'name' => 'FemalePic/'.$femalePics[$Fpic],
               'type' => 'post',
           ]);
       }
       if ($data['gender'] == 'male') {
            $malePics = array("male1.jpg","male2.jpg","male3.jpg","male4.jpg","male5.jpg","male6.jpg","male7.jpg","male8.jpg");
            $Mpic = array_rand($malePics,1);
           Image::create([
               'post_id' => $postP->id,
               'user_id' => $user->id,
               'name' => 'MalePic/'.$malePics[$Mpic],
               'type' => 'profile',
           ]);
           Image::create([
               'post_id' => $postP->id,
               'user_id' => $user->id,
               'name' => 'MalePic/'.$malePics[$Mpic],
               'type' => 'post',
           ]);
       }
       
       $user->email_verified_at = $date;
       $user->save();
       broadcast(new OnlineFriendEvent($user));
       Online::create([
           'user_id' => $user->id,
       ]);
        return $user;
    }
}
 