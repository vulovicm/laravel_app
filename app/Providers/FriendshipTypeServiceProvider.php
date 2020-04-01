<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class FriendshipTypeServiceProvider
 * @package App\Providers
 */
class FriendshipTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\FriendshipType\IFriendshipTypeEntityRepository',
            'App\Repository\FriendshipType\FriendshipTypeEntityRepository'
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
