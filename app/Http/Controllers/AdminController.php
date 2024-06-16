<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {

        $user = auth()->user();

        if ($user->roles()->exists()) {
            $userRoles = $user->roles()->pluck('name')->toArray();
            $userPermissions = $user->permissions()->pluck('name')->toArray();
        } else {
            $userRoles = [];
            $userPermissions = [];
        }

        return view('admin.index', compact('userRoles', 'userPermissions'));
    }

    public function articlesIndex()
    {
        $perPage = request()->input('per_page', 10);

        $articles = Article::query()
            ->with('user', 'category')
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        return view('admin.articles.index', compact('articles'));
    }

    public function usersIndex()
    {
        $perPage = request()->input('per_page', 10);

        $users = User::query()
            ->orderBy('updated_at', 'desc')
            ->withCount('articles')
            ->paginate($perPage);

        $users->load('roles');

        return view('admin.users.index', compact('users'));
    }
}
