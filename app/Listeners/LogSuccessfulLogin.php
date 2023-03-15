<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
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
    public function handle(Login $event): void
    {
        $date = Carbon::now()->format('Y-m-d');
        if($user = auth()->user())
        {
            $log = $user->logs()->firstOrCreate(['date' => $date]);
            $log->attempts++;
            $log->save();
        }
    }
}
