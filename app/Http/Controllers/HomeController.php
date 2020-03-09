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

    public function index()
    {
        $entries = Entry::where('user_id', auth()->id())->get();

        $twitterConnected = auth()->user()->isConnectedToTwitter();

        return view('home', compact(
            'entries', 'twitterConnected'
        ));
    }

}
