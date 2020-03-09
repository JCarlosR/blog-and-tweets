<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    // $user->entries
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function isConnectedToTwitter()
    {
        return $this->twitter_oauth_token
            && $this->twitter_oauth_token_secret;
    }

    public function storeTwitterInfo($data, $tokens)
    {
        $this->twitter_user_id = $data->id_str;
        $this->twitter_screen_name = $data->screen_name;
        $this->twitter_image = $data->profile_image_url_https;

        $this->twitter_oauth_token = $tokens['oauth_token'];
        $this->twitter_oauth_token_secret = $tokens['oauth_token_secret'];

        $this->save();
    }

    public function disconnectTwitter()
    {
        $this->twitter_oauth_token = null;
        $this->twitter_oauth_token_secret = null;

        $this->save();
    }

    public function getProfileImageUrl()
    {
        return $this->twitter_image ?: url('/images/default-avatar.jpg');
    }

    public function getProfileUrl()
    {
        return url("@$this->username");
    }
}
