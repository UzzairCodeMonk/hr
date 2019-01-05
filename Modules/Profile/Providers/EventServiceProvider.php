<?php

namespace Modules\Profile\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Datakraf\Events\UserCreated;
use Datakraf\Events\UserUpdated;
use Modules\Profile\Listeners\UpdatePersonalDetailOnUserUpdate;
use Modules\Profile\Listeners\CreatePersonalDetailOnUserCreation;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $listen = [
        UserCreated::class => [
            CreatePersonalDetailOnUserCreation::class
        ],
        UserUpdated::class => [
            UpdatePersonalDetailOnUserUpdate::class
        ]
    ];
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
