@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                                <tr>
                                    <h4>Title</h4>
                                    <td>{{ $post->title }}</td>
                                    <h4>Text</h4>
                                    <td>{{ $post->body }}</td>
                                    <h4>Image</h4>
                                    <td><img src="/uploads/posts/{{ $post->image }}"/></td>
                                </tr>

                                <h3>Comments</h3>
                                @if (Auth::check())
                                {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
                                <p>{{ Form::textarea('body', old('body'),['style' => 'width: 300px; height: 50px']) }}</p>
                                {{ Form::hidden('post_id', $post->id) }}
                                <p>{{ Form::submit('Send') }}</p>
                                {{ Form::close() }}
                                @endif
                                @forelse ($post->comments as $comment)
                                <p>{{ $comment->user->name }} {{$comment->created_at}}</p>
                                <p>{{ $comment->body }}</p>
                                <hr>
                                @empty
                                <p>This post has no comments</p>

                                @endforelse
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
