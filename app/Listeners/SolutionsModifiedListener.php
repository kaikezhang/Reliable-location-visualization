<?php

namespace App\Listeners;
use App\Solution;
use App\Events\SolutionsModified;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SolutionsModifiedListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
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
     * @param  SolutionsModified  $event
     * @return void
     */
    public function handle(SolutionsModified $event)
    {
        Cache::forever('nodeses', Solution::getNodeses());
        Cache::forever('problems', Solution::getProblmes());
        Cache::forever('solvers', Solution::getSolvers());
        Cache::forever('statuses', Solution::getStatuses());
        Log::info('Cache updated');
    }
}
