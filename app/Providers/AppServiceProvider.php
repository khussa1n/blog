<?php

namespace App\Providers;

use App\Services\AdminService;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService();
        });

        $this->app->singleton(ArticleService::class, function ($app) {
            return new ArticleService();
        });

        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService();
        });

        $this->app->singleton(AdminService::class, function ($app) {
            return new AdminService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
