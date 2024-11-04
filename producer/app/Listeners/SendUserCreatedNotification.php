<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Jobs\WelcomeUserJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class SendUserCreatedNotification
{

    public function handle(UserCreated $event): void
    {
        WelcomeUserJob::dispatch($event->email);
        //Artisan::call('send-new-user', ['email' => $event->email]);
    }
}
