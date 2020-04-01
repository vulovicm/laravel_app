<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class FriendshipServiceProvider
 * @package App\Providers
 */
class FriendshipServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\Friendship\IFriendshipEntityRepository',
            'App\Repository\Friendship\FriendshipEntityRepository'
        );
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
