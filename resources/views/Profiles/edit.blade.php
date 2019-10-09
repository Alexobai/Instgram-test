@extends('layouts.app')

@section('content')
<div class="container">
<form action="/profile/{{$user->id}}" enctype = "multipart/form-data" method = "post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">title</label>
                            <input id="title" 
                            type="text" 
                            class="form-control @error('title') is-invalid @enderror" 
                            name = "title"
                            value="{{ old('title') ?? $user->profile->title}}"  
                            autocomplete="title" autofocus>

                                @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                </div>
                <div class="form-group row">
                        <label for="discription" class="col-md-4 col-form-label">discription</label>
                            <input id="discription" 
                            type="text" 
                            class="form-control @error('discription') is-invalid @enderror" 
                            name = "discription"
                            value="{{ old('discription') ?? $user->profile->description}}"  
                            autocomplete="discription" autofocus>

                                @error('discription')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                </div>
                <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label">url</label>
                            <input id="url" 
                            type="text" 
                            class="form-control @error('url') is-invalid @enderror" 
                            name = "url"
                            value="{{ old('url') ?? $user->profile->url}}"  
                            autocomplete="url" autofocus>

                                @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile image</label>
                    <input type="file", class = "form-control-file" id = "image" name = "image">
                                @error('image')
                                        
                                            <strong>{{ $message }}</strong>
                                        
                                @enderror
                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
