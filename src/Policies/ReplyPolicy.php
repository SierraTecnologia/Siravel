<?php

namespace Siravel\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Siravel\Models\User;
use Siravel\Models\Reply;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Reply $reply): bool
    {
        return $user->may('manage_topics') || $reply->user_id == $user->id;
    }
}
