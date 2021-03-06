<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//ProfilController
Route::get('/profile', [App\Http\Controllers\ProfilController::class, 'index']);
Route::post('/UserProfile', [App\Http\Controllers\ProfilController::class, 'UserProfile']);
Route::get('/GatHashed', [App\Http\Controllers\ProfilController::class, 'GatHashed']);
Route::get('/verify', [App\Http\Controllers\ProfilController::class, 'verify']);
Route::post('/profile-update', [App\Http\Controllers\ProfilController::class, 'update']);
Route::post('/PasswordUpdate', [App\Http\Controllers\ProfilController::class, 'PasswordUpdate']);
Route::post('/ForgotPass', [App\Http\Controllers\ProfilController::class, 'ForgotPass']);
Route::post('/ResetPassword', [App\Http\Controllers\ProfilController::class, 'ResetPassword']);
Route::post('/BeforeRegister', [App\Http\Controllers\ProfilController::class, 'BeforeRegister']);
Route::get('/imagesProfile', [App\Http\Controllers\ProfilController::class, 'GetImages']);
Route::get('/videosProfile', [App\Http\Controllers\ProfilController::class, 'GetVideos']);
Route::post('/ProfileImages', [App\Http\Controllers\ProfilController::class, 'GetImagesProfile']);
Route::post('/LogoutUser', [App\Http\Controllers\ProfilController::class, 'LogoutUser']);
Route::get('/OnlineUsers', [App\Http\Controllers\ProfilController::class, 'OnlineUsers']); 

//FriendController
Route::post('/ProfileSearch', [App\Http\Controllers\FriendController::class, 'ProfileSearch']);
Route::post('/SendRequest', [App\Http\Controllers\FriendController::class, 'SendRequest']);
Route::post('/DeleteRequest', [App\Http\Controllers\FriendController::class, 'DeleteRequest']);
Route::post('/DeleteReq', [App\Http\Controllers\FriendController::class, 'DeleteReq']);
Route::get('/LoadRequests', [App\Http\Controllers\FriendController::class, 'LoadRequests']);
Route::post('/AcceptRequest', [App\Http\Controllers\FriendController::class, 'AcceptRequest']);
Route::post('/RemoveFriend', [App\Http\Controllers\FriendController::class, 'RemoveFriend']);
Route::post('/LoadFriends', [App\Http\Controllers\FriendController::class, 'LoadFriends']);
Route::post('/FriendsInCommon', [App\Http\Controllers\FriendController::class, 'FriendsInCommon']);
Route::get('/YouMayKnow', [App\Http\Controllers\FriendController::class, 'YouMayKnow']);

//PostController
Route::get('/GetPosts', [App\Http\Controllers\PostController::class, 'index']);
Route::post('/GetPost', [App\Http\Controllers\PostController::class, 'show']);
Route::post('/create-post', [App\Http\Controllers\PostController::class, 'create']); 
Route::post('/update-post', [App\Http\Controllers\PostController::class, 'update']); 
Route::post('/delete-post', [App\Http\Controllers\PostController::class, 'destroy']); 
Route::post('/UserPosts', [App\Http\Controllers\PostController::class, 'UserPosts']);
Route::get('/posts-saved', [App\Http\Controllers\PostController::class, 'saved']); 
Route::post('/save-post', [App\Http\Controllers\PostController::class, 'save']);
Route::post('/like-post', [App\Http\Controllers\PostController::class, 'like']);
Route::post('/SinglePost', [App\Http\Controllers\PostController::class, 'SinglePost']);

//ChatController
Route::get('/ChatList', [App\Http\Controllers\ChatController::class, 'ChatList']); 
Route::post('/NewMessage', [App\Http\Controllers\ChatController::class, 'NewMessage']); 
Route::post('/LoadMessages', [App\Http\Controllers\ChatController::class, 'LoadMessages']); 
Route::get('/UnreadMessages', [App\Http\Controllers\ChatController::class, 'UnreadMessages']); 
Route::post('/DeleteChat', [App\Http\Controllers\ChatController::class, 'DeleteChat']); 
Route::post('/ChatSearch', [App\Http\Controllers\ChatController::class, 'ChatSearch']); 
Route::post('/userInfoReq', [App\Http\Controllers\ChatController::class, 'userInfoReq']); 

//CommentController
Route::post('/add-comment', [App\Http\Controllers\CommentController::class, 'store']); 
Route::post('/get-comments', [App\Http\Controllers\CommentController::class, 'show']); 
Route::post('/like-comment', [App\Http\Controllers\CommentController::class, 'like']); 
Route::post('/delete-comment', [App\Http\Controllers\CommentController::class, 'destroy']); 
Route::post('/SharePost', [App\Http\Controllers\CommentController::class, 'SharePost']); 

//NotificationController
Route::get('/LoadNotif', [App\Http\Controllers\NotificationController::class, 'LoadNotif']); 
Route::post('/DeleteNotif', [App\Http\Controllers\NotificationController::class, 'DeleteNotif']); 

//StoryController
Route::post('/add-storie', [App\Http\Controllers\StoryController::class, 'create']);  
Route::get('/GetStories', [App\Http\Controllers\StoryController::class, 'index']);  
Route::post('/StorySee', [App\Http\Controllers\StoryController::class, 'StorySee']);  