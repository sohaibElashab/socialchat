<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        return response()->json($user);
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
            'quote' => 'required',
            'website' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
            'linkedin' => 'required',
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

        return response()->json($user);
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
