<?php

namespace vendor\model;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface
{
    protected $subscribedTopics = array();
    protected $messages = array();
    protected $clients = null;
    protected $data = null;

    public function __construct()
    {

        $this->clients = new \SplObjectStorage();

    }

    public function onSubscribe(ConnectionInterface $conn, $topic)
    {

        $this->subscribedTopics[$topic->getId()] = $topic;

        //enviar historico das mensagens
        if (isset($this->messages[$topic->getId()])) {
            $json = '['.$this->messages[$topic->getId()].']';

            //envia o histórico apenas para o usuário que acabou de "conectar/subscribe"
            $conn->event($topic, $json);
        }

        echo "onSubscribe ID:" . $conn->resourcerID;

    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {

        echo "onUnSubscribe ID:" . $conn->resourcerID;

    }

    public function onOpen(ConnectionInterface $conn)
    {

        /** Adiciono as conexãoes */
        $this->clients->attach($conn);

        echo "onOpen ID:" . $conn->resourcerID;

        foreach ($this->clients as $keyClient => $resulClient)
        {

            $resulClient->send($conn->resourcerID);

        }

    }

    public function onClose(ConnectionInterface $conn)
    {

        echo "onClose ID:" . $conn->resourcerID;

    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();

    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        if (!isset($this->messages[$topic->getId()])) {
            /** Pego a mensagem do tópico correspondente */
            $this->messages[$topic->getId()] = json_encode($event);
        } else {
            $this->messages[$topic->getId()] .= ', '.json_encode($event);
        }

        //dispara a mensagem para todos usuários do mesmo tópicp
        $topic->broadcast($event);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {

    }
}