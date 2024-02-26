<?php

namespace App\Listeners;

use App\Events\OperatorMail;
use App\Mail\MailableCreateAccount;
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
    public function handle(OperatorMail $event)
    {
        if ($event->whatHappend === 'create') {
            // Send creation email
            Mail::to($event->operator->email)->send(new MailableCreateAccount($event->operator, $event->password));
        } else {
            // Send update email
            Mail::to($event->operator->email)->send(new MailableUpdateOperator($event->operator));
        }
    }
}
