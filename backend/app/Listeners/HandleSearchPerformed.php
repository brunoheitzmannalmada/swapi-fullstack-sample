<?php

namespace App\Listeners;

use App\Events\SearchPerformed;
use App\Jobs\ProcessSearchStatistics;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleSearchPerformed
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
    public function handle(SearchPerformed $event): void
    {
        ProcessSearchStatistics::dispatch(
            $event->query
        );
    }
}
