<?php

namespace App\Providers;

use App\Repository\implementation\UserRepository;
use App\Repository\interfaces\IUserRepository;
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
        $this->app->bind(IUserRepository::class,UserRepository::class);
        // $this->register(DalServiceProvider::class);
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
