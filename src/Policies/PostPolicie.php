<?php

namespace Siravel\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Siravel\Models\Blog\Post;
use Siravel\Models\User;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param \Siravel\Models\User $user
     * @param Post $post
     *
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        if ($post->published) {
            return true;
        }

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }

        // admin overrides published status
        if ($user->can('view unpublished posts')) {
            return true;
        }

        // authors can view their own unpublished posts
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \Siravel\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param \Siravel\Models\User $user
     * @param Post $post
     *
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if ($user->can('edit own posts')) {
            return $user->id === $post->user_id;
        }

        if ($user->can('edit all posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param \Siravel\Models\User $user
     * @param Post $post
     *
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if ($user->can('delete own posts')) {
            return $user->id === $post->user_id;
        }

        if ($user->can('delete any post')) {
            return true;
        }
    }
}
