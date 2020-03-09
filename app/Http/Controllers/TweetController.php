<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'hidden' => 'required|boolean'
        ]);

        Tweet::updateOrCreate([
            'tweet_id' => $validatedData['id'],
            'user_id' => auth()->id()
        ], [
            'hidden' => $validatedData['hidden']
        ]);

        return back();
    }
}
