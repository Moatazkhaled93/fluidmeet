<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//classes
use App\Repository\Eloquent\PharmaciesRepository;
use App\Repository\Eloquent\ImagesRepository;
//interfaces
use App\Repository\Interfaces\PharmaciesRepositoryInterface;
use App\Repository\Interfaces\ImagesRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PharmaciesRepositoryInterface::class, PharmaciesRepository::class);
        $this->app->bind(ImagesRepositoryInterface::class, ImagesRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
