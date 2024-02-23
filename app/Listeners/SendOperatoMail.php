<?php

namespace App\Listeners;

use App\Events\OperatorMail;
use App\Mail\MailableUpdateOperator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOperatoMail
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
    public function handle(OperatorMail $event): void
    {
        Mail::to($event->operator->email)->send(new MailableUpdateOperator($event->operator));
    }
}
