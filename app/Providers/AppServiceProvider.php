<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Eloquents\PostRepository;
use App\Repositories\PostRepositoryInterface;
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
        //
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);

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
