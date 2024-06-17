<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;

class AdminService
{
    public function getUserRolesAndPermissions($user)
    {
        if ($user->roles()->exists()) {
            $userRoles = $user->roles()->pluck('name')->toArray();
            $userPermissions = $user->permissions()->pluck('name')->toArray();
        } else {
            $userRoles = [];
            $userPermissions = [];
        }

        return compact('userRoles', 'userPermissions');
    }

    public function getArticles($perPage)
    {
        $query = Article::query();
        $totalItems = $query->count();
        $articles = $query
            ->with('user', 'category')
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        return compact('articles', 'totalItems');
    }

    public function getUsers($perPage)
    {
        $query = User::query();
        $totalItems = $query->count();
        $users = $query
            ->orderBy('updated_at', 'desc')
            ->withCount('articles')
            ->paginate($perPage);
        $users->load('roles');

        return compact('users', 'totalItems');
    }
}
