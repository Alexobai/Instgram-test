@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5"> <!--p is pading all the way round-->
            <img src="/storage/{{$user->profile->profileImage()}}" class = "rounded-circle w-100">
        </div>
        <div class="col-9 pt-5 pl-5">
            <div class = "d-flex justify-content-between align-items-baseline">
               <div class = "d-flex align-item-center pb-3">
                    <div class = "h-4" >{{$user->username}}</div>

                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button> <!--ml-4 = margin left 4 -->
               </div>

                @can('update',$user->profile)
                    <a href="/p/create">Add a new post</a> 
                @endcan
                 
            </div> <!-- echo out sth in view method -->
            @can('update',$user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile Link</a>
            @endcan
            <div class = "d-flex">
                <div class = "pr-5"><strong>{{$postCount}}</strong> posts</div>
                <div class = "pr-5"><strong>{{$followersCount}}</strong> followers</div>
                <div class = "pr-5"><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class = "pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-4">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4 ">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </a>
        </div>
        <div class="col-4">
            <img src="http://steam.cryotank.net/wp-content/gallery/batmanarkhamknight/Batman-AK-05.png" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://patchbot.io/images/games/call_of_duty_black_ops_4_md.jpg" class = "w-100">
        </div>
        @endforeach
       
    </div>
</div>
@endsection
