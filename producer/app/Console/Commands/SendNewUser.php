<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendNewUser extends Command
{

    protected $signature = 'send-new-user';
    protected $description = 'Command description';

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->exchange_declare('welcome_event', 'direct');

        $channel->queue_declare('send_email_queue', false, true, false, false);
        $channel->queue_bind('send_email_queue', 'welcome_event', 'send_email');

        $channel->close();
        $connection->close();
    }
}
