<?php

// PostController.php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
class PostController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function index()
    {
        $posts = Post::all();

        return view('home', compact('posts'));
    }

    public function create()
    {
        return view('post');
    }

    public function store()
    {

//        $post=User::all();
        return redirect('show');

    }

    public function show($id)
    {
        $users=User::all();
        $post = Post::find($id);

        return view('show', compact('post','users'));

    }

    public function insert(Request $request)
    {
             $this->validate($request, array(
            'title' => 'required',
            'body' => 'required',

        ));
        $posts = new Post();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(300, 300)->save(public_path('/uploads/posts/' . $filename));

//            $posts = Post::all();
            $posts->image = $filename;

        }
        $posts->title = $request->title ;
        $posts->body = $request->body ;

        $posts->user_id = Auth::user()->id;
        $posts->save();


        return redirect('/home');


    }

}