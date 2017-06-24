<?php

namespace App\Listeners;

use App\Events\StudentWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailCreatedConfirmation
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
     * @param  StudentWasCreated  $event
     * @return void
     */
    public function handle(StudentWasCreated $event)
    {
        echo 'efkvmdfkvmdfkvmdfkvmdfkvmdkfvmkdfmvkdfmvkdfmvkdfmvkfdmvkdfmvkdfmvdfkv';
    }
}
