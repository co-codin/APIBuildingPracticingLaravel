<?php

namespace App;

use App\{Topic, Post};
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    // protected $appends = ['avatar'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function getAvatarAttribute()
    // {
    //   return $this->avatar();
    // }

   public function avatar()
   {
       return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=45&d=mm';
   }

   public function ownsTopic(Topic $topic)
   {
     return $this->id === $topic->user_id;
   }

   public function ownsPost(Post $post)
   {
     return $this->id === $post->user_id;
   }
}
