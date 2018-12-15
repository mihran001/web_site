@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <br class="search" role="search">

                        @if(isset($details))
                            <div>
                                <h4> The Search results for your query <b> {{ $query }} </b> are :</h4>

                            </div>
                            @foreach($details as $user)
                                <br><br>
                                    <img src="/uploads/avatars/{{ $user->avatar }}"  style="width:100px; height:100px;  margin-right:25px;">
                                    <a href="{{ url('users', $user->id) }}">{{$user->name}}</a>
                            @endforeach

                        @elseif(isset($message))

                            <p>  {{ $message}}  </p>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
