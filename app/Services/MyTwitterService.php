<?php namespace App\Services;

use App\Tweet;
use App\User;
use Thujohn\Twitter\Facades\Twitter;

class MyTwitterService
{
    public function getTweets(User $user)
    {
        $tweets = Twitter::getUserTimeline([
            'screenName' => $user->twitter_screen_name,
            'count' => 20,
            'format' => 'array'
        ]);

        return $this->recognizeHiddenTweets($tweets, $user->id);
    }

    public function getVisibleTweets(User $user)
    {
        return collect($this->getTweets($user))
            ->filter(function ($tweet) {
                return $tweet['hidden'] === false;
            });
    }

    private function recognizeHiddenTweets(array $tweets, $userId)
    {
        $hiddenTweets = Tweet::where('user_id', $userId)
            ->where('hidden', true)
            ->pluck('tweet_id')
            ->toArray();

        foreach ($tweets as $key => $tweet) {
            $tweets[$key]['hidden'] = in_array($tweet['id'], $hiddenTweets);
        }

        return $tweets;
    }
}
