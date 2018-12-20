<?php

namespace Modules\Leave\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Datakraf\Events\UserCreated;
use Modules\Leave\Listeners\CreateLeaveEntitlement;
use Illuminate\Support\Facades\Event;

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
            CreateLeaveEntitlement::class,
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
