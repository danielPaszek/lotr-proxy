<?php

namespace App\Providers;

use App\Models\Repositories\LightCharacterRepository;
use App\Models\Repositories\SearchNamesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SearchNamesRepositoryInterface::class, LightCharacterRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
