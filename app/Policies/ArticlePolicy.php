<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        return $user->hasPermissionTo('edit_articles') || $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can archive the model.
     */
    public function archive(User $user, Article $article): bool
    {
        return $user->hasPermissionTo('archive_articles') || $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can publish the model.
     */
    public function publish(User $user, Article $article): bool
    {
        return $user->hasPermissionTo('publish_articles') || $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return $user->hasPermissionTo('delete_articles') || $user->id === $article->user_id;
    }
}
