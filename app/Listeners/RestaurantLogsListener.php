<?php

namespace App\Listeners;

use App\Events\RestaurantLogsEvent;
use App\Mail\MailableRestaurantLogs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RestaurantLogsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RestaurantLogsEvent $event): void
    {
        // dd($event->ownerResturant);
        Mail::to($event->ownerResturant->email)->send(new MailableRestaurantLogs($event));
    }
}
