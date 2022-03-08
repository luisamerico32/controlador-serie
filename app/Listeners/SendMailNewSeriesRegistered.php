<?php

namespace App\Listeners;

use App\Events\EventNewSeries;
use App\Mail\MailNewSeries;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailNewSeriesRegistered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventNewSeries  $event
     * @return void
     */
    public function handle(EventNewSeries $event)
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            $index = $key + 1;

            $mail = new MailNewSeries(
                $event->name,
                $event->seasons,
                $event->episodes
            );

            $when = now()->addSecond($index * 5);
            Mail::to($user)->later($when, $mail);
        }
    }
}
