<?php

namespace App\Providers;

use App\Http\Controllers\Admin\PostController;
use App\Repositories\Admin\ImageRepository;
use App\Repositories\ImageRepositoryInterface;
use App\Services\Admin\PostService;
use App\Services\AdminServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(PostController::class)
            ->needs(AdminServiceInterface::class)->give(function($app) {
                return $app->make(PostService::class);
            });

        //telescope
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
