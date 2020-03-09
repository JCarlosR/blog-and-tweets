@extends('layouts.app')

@section('content')
<div class="container">
    @if ($user->id === auth()->id())
        <div class="alert alert-info">
            You are seeing your own profile in public mode.
            <a href="{{ route('home') }}">Click here</a> to manage your entries and tweets.
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Tweets</div>

                <div class="card-body">
                    Twitter API (soon)
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>

                <div class="card-body">
                    <p>Published entries:</p>
                    <ul>
                        @foreach ($entries as $entry)
                            <li>
                                <a href="{{ $entry->getUrl() }}">{{ $entry->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
