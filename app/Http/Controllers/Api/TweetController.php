<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MyTwitterService;
use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index(MyTwitterService $twitterService)
    {
        $user = auth()->user();

        if ($user->isConnectedToTwitter()) {
            $tweets = $twitterService->getTweets($user);
        } else {
            $tweets = [];
        }

        return $tweets;
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'hidden' => 'required|boolean'
        ]);

        return Tweet::updateOrCreate([
            'tweet_id' => $validatedData['id'],
            'user_id' => auth()->id()
        ], [
            'hidden' => $validatedData['hidden']
        ]);
    }
}
