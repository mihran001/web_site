@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h2 style="margin-left:5%">{{Auth::user()->name }}</h2>
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:200px; height:200px; border-radius:50%">

                </div>
            </div>
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
@endsection

