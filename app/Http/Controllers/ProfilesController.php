<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; 
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //
    public function index(\App\User $user)//we can do this when the routes have the same name of the variable
    {
        //$user in the bracket is access to the web.php profile/{user} and gives the id of the user
        //dd($user);        show what is next to the profile/
        $user = User::findOrFail($user); //the User means the User.php in app explorer, the User in app is a model
        //the User here represent the User row in databse
        $follows = (auth()->user()) ? auth()->user()-> following -> contains($user->id) : false;

        $postCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), function() use ($user) {
            return $user->posts->count();
        });
        $followersCount = Cache::remember('count.followers.' . $user->id, now()->addSeconds(30), function() use ($user) {
            return $user->profile->followers->count();
        });
        $followingCount = Cache::remember('count.following.' . $user->id, now()->addSeconds(30), function() use ($user) {
            return $user->following->count();
        });

        return view('profiles.index',compact('user', 'follows','postCount','followersCount','followingCount'));//pass data into the view, the second parameter can be an array
    }
    public function edit(\App\User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit',compact('user'));
    }
    public function update(\App\User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',
        ]);

        
        
        if(request('image')){
            $imagePath = request('image')->store('profile','public');//first parameter in store is the directory, second is the driver we want to use
        
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }
       
        auth()->user()->profile->update(array_merge($data
            ,$imageArray ?? []
        ));
        return redirect("/profile/{$user->id}");
    }
}
