<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Services\MyTwitterService;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(MyTwitterService $twitterService)
    {
        $entries = Entry::where('user_id', auth()->id())->get();

        if ($twitterConnected = auth()->user()->isConnectedToTwitter()) {
            $tweets = $twitterService->getTweets(auth()->user());
        } else {
            $tweets = [];
        }

        return view('home', compact(
            'entries', 'tweets', 'twitterConnected'
        ));
    }

}
