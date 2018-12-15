@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Post</div>
                    <div class="card-body">
                        <form action = "{{route ('post.insert') }}" method = "POST" enctype = "multipart/form-data" >
                            @csrf
                            <div class = "row">

                                <div class = "col-md-6">
                                    <input type="text" placeholder="your name" name="title" class="form-control" required/>
                                </div>

                                <div class = "col-md-6">
                                    <input type = "file" name = "image" id="image" class = "form-control">
                                </div>

                                <div class = "col-md-6">
                                    <textarea name="body"  placeholder="location" class="form-control" required></textarea>
                                </div>

                                <div class = "col-md-6">
                                    <button type = "submit" class = "btn btn-dark"> submit </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection