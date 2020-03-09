<?php

namespace App\Policies;

use App\Entry;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Entry $entry)
    {
        return $user->id === $entry->user_id;
    }
}
