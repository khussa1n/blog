<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use App\Services\ArticleService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $adminService;
    protected $articleService;
    protected $userService;

    public function __construct(AdminService $adminService, ArticleService $articleService, UserService $userService)
    {
        $this->adminService = $adminService;
        $this->articleService = $articleService;
        $this->userService = $userService;

    }

    public function index()
    {
        $user = Auth::user();
        $data = $this->adminService->getUserRolesAndPermissions($user);

        return view('admin.index', $data);
    }

    public function articlesIndex()
    {
        $perPage = request()->input('per_page', 10);
        $data = $this->articleService->getArticles($perPage);

        return view('admin.articles.index', $data);
    }

    public function usersIndex()
    {
        $perPage = request()->input('per_page', 10);
        $data = $this->userService->getUsers($perPage);

        return view('admin.users.index', $data);
    }
}
