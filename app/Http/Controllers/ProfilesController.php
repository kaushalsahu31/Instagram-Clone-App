<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(User $user)
    { 
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // dd($follows);

        return view('profiles.index', compact('user', 'follows'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }
    public function update(User $user)
    {
        $data= request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',
        ]);
       

        if (request('image')){
            $imagePath =request('image')->store('profile','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imagearray= ['image'=> $imagePath];
            

        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imagearray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}