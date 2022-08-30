<?php

namespace App\Providers;

use App\Repository\implementation\UserRepository;
use App\Repository\interfaces\IUserRepository;
use Illuminate\Support\ServiceProvider;
class DalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $toBind = [
            IUserRepository::class =>UserRepository::class,
            // All repositories are registered in this map
        ];
        // foreach ($toBind as $interface => $implementation) {
        //     $this->app->bind($interface, $implementation);
        // }
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
