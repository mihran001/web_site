@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">

                            <img src="/uploads/avatars/{{$user->avatar }}" style="width:150px; height:150px; float:left; margin-right:25px;">
                            <h2>{{ $user->name }}'s Profile</h2>
                            <form enctype="multipart/form-data" action="/profile" method="post">
                                <label>Update Profile Image</label>
                                <input type="file" name="avatar">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-sm btn-primary">
                            </form>
                            <p class="mb-2">
                                <small>Following: <span class="badge badge-primary">{{ $user->follows()->get()->count() }}</span></small>
                                <small>Followers: <span class="badge badge-primary tl-follower">{{ $user->followers()->get()->count() }}</span></small>
                            </p>
                        </div>
                        <div class="col-9 mt-5">
                            <h1>POST`S</h1>
                            @foreach($posts as $post)
                                <div class="row">
                                    <div class="col-9">
                                        <div class="coment d-flex align-items-center ">
                                            <div class="d-flex w-50  justify-content-start flex-column">
                                                <img src="/uploads/posts/{{ $post->image }}" style="width:150px; height:150px;"/>
                                                <span>{{$post->comments->count()}} <a href="{{url("/show",$post->id)}}">{{ str_plural('comment', $post->comments->count()) }}</a></span>
                                            </div>
                                            <div class="w-50 ">
                                                <h4>Place</h4>
                                                <div>{{ $post->body }}</div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
