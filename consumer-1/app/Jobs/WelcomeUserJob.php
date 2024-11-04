<?php

namespace App\Jobs;

use App\Mail\SendEmailUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class WelcomeUserJob implements ShouldQueue
{
    use Queueable;

    public function __construct(protected string $email)
    {
        //
    }


    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SendEmailUser());
    }
}
