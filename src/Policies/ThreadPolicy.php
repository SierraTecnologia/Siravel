<?php

namespace Siravel\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Siravel\Models\User;
use Facilitador\Models\Messenger\Thread;
use Gate;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Thread $thread)
    {
        return $thread->hasParticipant($user->id);
    }
}
