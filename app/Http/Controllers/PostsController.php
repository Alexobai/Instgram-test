<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users= auth()->user()->following()->pluck('profiles.user_id');
        
        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);
        
        return view('posts.index',compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],    //multi rules, required and should be image type
        ]);

        /*$post = new \App\Post();     this is the complex way like doing in tinker

        $post->caption = $data['caption'];
        $post->save();
            */
        
        $imagePath = request('image')->store('uploads','public');//first parameter in store is the directory, second is the driver we want to use
        
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        //\App\Post::create(['column_name' => request()->get('value')]);
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image'=> $imagePath,
        ]);
        //\App\Post::create($data);
        return redirect('/profile/'.auth()->user()->id);
        //dd(request()->all());
    }
    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post')); //compact do the same thing as ['post'=>$post]
    }
}
