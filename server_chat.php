<?php

require 'autoload.php';
require './vendor/composer/vendor/autoload.php';

/** importação de classes */
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use vendor\model\Chat;

$server = IoServer::factory(

    new HttpServer(

        new WsServer(

            new Chat()

        )

    ),8080

);

$server->run();