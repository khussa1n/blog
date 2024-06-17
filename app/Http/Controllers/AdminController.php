<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
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
        $data = $this->adminService->getArticles($perPage);

        return view('admin.articles.index', $data);
    }

    public function usersIndex()
    {
        $perPage = request()->input('per_page', 10);
        $data = $this->adminService->getUsers($perPage);

        return view('admin.users.index', $data);
    }
}
