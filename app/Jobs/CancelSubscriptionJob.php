<?php

namespace App\Jobs;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CancelSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $subscriptionId;

    public function __construct($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscription = Subscription::find($this->subscriptionId);

        //1- Check if subscription exists and is still active
        if ($subscription && $subscription->status === 'active') {
            //2- Check if the subscription is older than 30 days
            if ($subscription->start_date->addDays(30)->isPast()) {
                //3- Cancel the subscription
                $subscription->update(['status' => 'canceled']);
            }
        }
    }
}
