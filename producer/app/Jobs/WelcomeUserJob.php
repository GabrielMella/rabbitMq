<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

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

    }
}
