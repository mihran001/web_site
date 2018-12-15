<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'activation_key', 'status', 'password','provider', 'provider_id','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function updateUser($data)
    {

        $user = $this->find($data['id']);
        $user->id = auth()->user()->id;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->mobile = $data['mobile'];

//        if($user->password === null){
//
//            $user->password = bcrypt($data['password']);
//            $user->status=$data['status']='active';
//
//        }



        $user->save();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
            ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
            ->withTimestamps();
    }

    public function follow($userId)
    {
        $this->follows()->attach($userId);
        return $this;
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }

    public function isFollowing($userId)
    {
        return (boolean) $this->follows()->where('follows_id', $userId)->first(['users.id']);
    }

}