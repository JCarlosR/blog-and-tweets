<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Services\MyTwitterService;
use App\User;

class UserController extends Controller
{
    public function show(User $user, MyTwitterService $twitterService)
    {
        $entries = Entry::where('user_id', $user->id)->get();

        if ($twitterConnected = $user->isConnectedToTwitter()) {
            $tweets = $twitterService->getVisibleTweets($user);
        } else {
            $tweets = [];
        }

        return view('users.show', compact(
            'user', 'entries', 'tweets', 'twitterConnected'
        ));
    }
}
