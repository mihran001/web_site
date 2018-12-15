<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Input;
Route::get('/', function () {
    return view('welcome');
});
Route::get('activation/{key}', 'Auth\RegisterController@activation');

Auth::routes();

Route::get('profile', 'HomeController@profile');

Route::post('profile', 'HomeController@update_avatar');

Route::get('/edit/user/{id}','HomeController@edit');

Route::post('/edit/user/{id}','HomeController@update');

Route::post('profile','HomeController@update_avatar');

Route::get('show/{id}', 'HomeController@show');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');

Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $user = \App\User::where('name','LIKE','%'.$q.'%')->get();
    if (empty($q)) {
        return view ('search')->withMessage('No Details found. Try to search again !');
        exit();
    }else

        if(count($user) > 0)
            return view('search')->withDetails($user)->withQuery ( $q );
        else return view ('search')->withMessage('No Details found. Try to search again !');

});

Route::get('/post/create', 'PostController@create')->name('post.create');


Route::post('/post/insert', 'PostController@insert')->name('post.insert');

Route::get('/posts', 'PostController@index')->name('posts');

Route::get('/post/show/{id}', 'PostController@show')->name('post.show');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');

Route::get('/post/{id}', 'PostController@show')->name('posts.show');

Route::get('/show/{id}', 'PostController@show');

Route::resource('comments', 'CommentsController');

Route::get('/chat', 'ChatController@index')->name('chat');

Route::get('/users/{id}', 'HomeController@show');

//Route::get('/message', 'MessageController@index')->name('message');

//Route::post('/message', 'MessageController@store')->name('message.store');


Route::post('getFriends', 'HomeController@getFriends');
Route::post('/session/create', 'SessionController@create');
Route::post('/session/{session}/chats', 'ChatController@chats');
Route::post('/session/{session}/read', 'ChatController@read');
Route::post('/session/{session}/clear', 'ChatController@clear');
Route::post('/session/{session}/block', 'BlockController@block');
Route::post('/session/{session}/unblock', 'BlockController@unblock');
Route::post('/send/{session}', 'ChatController@send');





Route::group(['middleware' => 'auth'], function () {
    Route::get('users', 'UsersController@index')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
});
Route::group([ 'middleware' => 'auth' ], function () {
    // ...
    Route::get('/notifications', 'UsersController@notifications');
});