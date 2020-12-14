<?php

require 'autoload.php';
require './vendor/composer/vendor/autoload.php';

/** importação de classes */
use \vendor\model\Pusher;
use React\EventLoop\Factory;
use React\Socket\Server;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Wamp\WampServer;

$loop = Factory::create();
$pusher = new Pusher();

$webSocket = new Server('0.0.0.0:8082', $loop);
$webServer = new IoServer(

    new HttpServer(

        new WsServer(

            new WampServer(

                $pusher

            )

        )

    ),

    $webSocket

);

$loop->run();