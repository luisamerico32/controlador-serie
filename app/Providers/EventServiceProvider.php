<?php

namespace App\Providers;

use App\Events\EventDeletedSeries;
use App\Events\EventNewSeries;
use App\Listeners\DeleteBackgroundSeries;
use App\Listeners\LogMailNewSeriesRegistered;
use App\Listeners\SendMailNewSeriesRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
//        EventNewSeries::class => [
//            SendMailNewSeriesRegistered::class,
//            LogMailNewSeriesRegistered::class
//        ],
//        EventDeletedSeries::class => [
//            DeleteBackgroundSeries::class
//        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
