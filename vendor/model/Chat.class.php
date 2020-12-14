<?php

/** Defino o local da classes */
namespace vendor\model;

/** Importação de classes */
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {

    private $clients = null;
    private $data = null;

    /** Método construtor */
    public function __construct() {

        $this->clients = new \SplObjectStorage();

    }

    /** Quando ocorrer uma conexão */
    public function onOpen(ConnectionInterface $conn) {

        /** Adiciono as conexãoes */
        $this->clients->attach($conn);

        /** Escrevo a conexão */
        echo "\n";
        echo "Nova conexão: {$conn->resourceId}\n";
        echo "\n";

    }

    /** Quando eu tenho uma nova mensagem */
    public function onMessage(ConnectionInterface $from, $data) {

        /** Parâmetros de entrada */
        $this->data = json_decode($data);

        /** Percorro todos os usuarios online */
        foreach ($this->clients as $client)
        {

            /** Envio da mensagem */
            $client->send(json_encode($this->data));

        }

    }

    /** Quando a conexão for encerrada */
    public function onClose(ConnectionInterface $conn) {

        /** Se a conexão for fechada, eu removo-o */
        $this->clients->detach($conn);

        /** Escrevo a conexão */
        echo "\n";
        echo "Conexão encerrada: {$conn->resourceId}\n";
        echo "\n";

    }

    /** Quando ocorrer erro */
    public function onError(ConnectionInterface $conn, \Exception $e) {

        $conn->close();

        echo "\n";
        echo "Um erro ocorreu: {$e->getMessage()}\n";
        echo "\n";

    }

}
