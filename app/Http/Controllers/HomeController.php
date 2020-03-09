<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Tweet;
use Illuminate\Http\Request;
use Thujohn\Twitter\Facades\Twitter;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entries = Entry::where('user_id', auth()->id())->get();

        if ($twitterConnected = auth()->user()->isConnectedToTwitter()) {
            $tweets = Twitter::getUserTimeline(['count' => 20, 'format' => 'array']);
            $tweets = $this->recognizeHiddenTweets($tweets);
        } else {
            $tweets = collect();
        }

        return view('home', compact(
            'entries', 'tweets', 'twitterConnected'
        ));
    }

    private function recognizeHiddenTweets(array $tweets)
    {
        $hiddenTweets = Tweet::where('user_id', auth()->id())
            ->where('hidden', true)->pluck('tweet_id')->toArray();

        foreach ($tweets as $key => $tweet) {
            $tweets[$key]['hidden'] = in_array($tweet['id'], $hiddenTweets);
        }

        return $tweets;
    }
}
