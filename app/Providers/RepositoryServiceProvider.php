<?php

namespace App\Providers;


use App\Jumia\Repository\CustomerRepositoryInterface;
use App\Jumia\Repository\Eloquent\BaseRepository;
use App\Jumia\Repository\Eloquent\CustomerRepository;
use App\Jumia\Repository\EloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
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
