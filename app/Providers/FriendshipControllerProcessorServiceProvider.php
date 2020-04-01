<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class FriendshipControllerProcessorServiceProvider
 * @package App\Providers
 */
class FriendshipControllerProcessorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\ControllerProcessor\IFriendshipControllerProcessor',
            'App\Http\ControllerProcessor\FriendshipControllerProcessor'
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
