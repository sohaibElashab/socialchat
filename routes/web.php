<?php

use Illuminate\Support\Facades\Route;

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
//Route::post('/FriendProfile', [App\Http\Controllers\FriendController::class, 'index']);

//PostController
Route::post('/create-post', [App\Http\Controllers\PostController::class, 'create']); 
Route::post('/GetPost', [App\Http\Controllers\PostController::class, 'show']);
Route::get('/GetPosts', [App\Http\Controllers\PostController::class, 'index']);
