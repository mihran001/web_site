<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
//use App\posts;
class CommentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('home', compact('post'));
    }
    public function index()
    {

        return view('home', compact('comments'));
    }
    public function store(CommentRequest $request)
    {
        $posts = Post::findOrFail($request->post_id);

        Comment::create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'post_id' => $posts->id
        ]);
        return redirect()->route('posts.show', $posts->id);
    }
}