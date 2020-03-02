<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the post.
     *
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
    }

    /**
     * Determine whether the user can create posts.
     *
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the post.
     *
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
    }
}
