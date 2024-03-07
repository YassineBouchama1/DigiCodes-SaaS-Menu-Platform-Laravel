<?php

namespace App\Jobs;

use App\Models\Subscription;
use Carbon\Carbon;
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

        // Check if subscription exists and is still active
        if ($subscription && $subscription->status === 'active') {
            // Convert start_date to a Carbon instance
            $startDate = Carbon::parse($subscription->start_date);

            // Check if the subscription is older than 30 days
            if ($startDate->addDays(30)->isPast()) {
                // Cancel the subscription
                $subscription->update(['status' => 'canceled']);
            }
        }
    }
}
