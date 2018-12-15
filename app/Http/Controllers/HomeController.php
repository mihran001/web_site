<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Image;
use Show;
use App\Post;

use App\Http\Resources\UserResource;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $users = User::where('id', auth()->user()->id)->get();
//        $posts = Post::all();
        $posts = Post::whereIn('user_id', auth()->user()->follows()->pluck('follows_id'))->orderBy('created_at', 'desc')->get();
        return view('home',compact('users','posts')) ;
    }


    public function edit($id)
    {
        $user = User::where('id', auth()->user()->id)
            ->where('id', $id)
            ->first();

        return view('edit', compact('user', 'id'));
    }


    public function profile()
    {
        $user = Auth::user();
        $posts = Post::all()->where('user_id',$user->id);

        return view('profile',compact('posts', 'user'));
    }

    public function show($id)
    {

        $user = User::findOrFail($id);
        $posts = Post::all()->where('user_id',$user->id);


        return view('user',compact( 'user','posts'));
    }

    public function update(Request $request, $id)
    {
        $user = new User();
        $data = $this->validate($request, [
            'name'=>'required',
            'email'=> 'required',
            'mobile'=> 'required'

        ]);
        $data['id'] = $id;
        $user->updateUser($data);

        return redirect('/home');
    }

    public function update_avatar(Request $request){

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            if(Auth::user()->provider){

                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );


            }else{
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );

            }


            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            $posts = Post::all();
        }
//        return view('profile', array('user' => Auth::user()) );
        return view('profile', compact('posts'),array('user' => Auth::user()) );
    }
    public function getFriends()
    {
        return UserResource::collection(User::where('id', '!=', auth()->id())->get());
    }
}
