@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($entries->isEmpty())
                        <p>You didn't publish any entry yet.</p>
                    @else
                        <p>My entries:</p>
                        <ul>
                        @foreach ($entries as $entry)
                            <li>
                                <a href="{{ $entry->getUrl() }}">{{ $entry->title }}</a>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Twitter</div>

                @if ($twitterConnected)
                    <ul class="list-group list-group-flush">
                        @foreach ($tweets as $tweet)
                            <li class="list-group-item">
                                <p><small>{{ $tweet['created_at'] }}</small></p>
                                <p>{{ $tweet['text'] }}</p>

                                @if ($tweet['hidden'])
                                    <a href="{{ url('/tweets?hidden=0&id='.$tweet['id']) }}">
                                        Un-hide tweet
                                    </a>
                                @else
                                    <a href="{{ url('/tweets?hidden=1&id='.$tweet['id']) }}">
                                        Hide tweet
                                    </a>
                                @endif
                            </li>
                        @endforeach
                        <li class="list-group-item">
                            <a href="{{ url('/twitter/logout') }}" class="btn btn-primary">
                                Disconnect your Twitter account
                            </a>
                        </li>
                    </ul>
                @else
                    <div class="card-body">
                        <a href="{{ url('/twitter/login') }}" class="btn btn-primary">
                            Connect your Twitter account
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
