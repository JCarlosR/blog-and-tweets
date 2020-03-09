<?php

namespace App\Http\Controllers;

use App\Entry;
use App\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        // A GROUP_CONCAT with LIMIT is not supported in MySQL
        // so we could add an additional column to the entries table,
        // to keep track of the last 3 entries of each user.
        // That boolean column would facilitate to query the last 3 entries for each one.

        // An alternative solution could be to develop a cache strategy.
        // All of these in order to avoid multiple queries or processing lots of data via PHP.

        $entries = Entry::with('user')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('welcome', compact('entries'));
    }

    public function show(Entry $entryBySlug)
    {
        return view('entries.show', [
            'entry' => $entryBySlug
        ]);
    }
}
