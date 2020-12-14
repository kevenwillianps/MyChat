<?php

/** Defino o local da classe */
namespace vendor\controller\Message;

/** Importação de classes */
use \vendor\model\Main;

class MessageValidate
{

    /** Parâmetros da classe */
    private $main = null;
    private $errors = array();

    private $message_id = null;
    private $usuario_id = null;
    private $cliente_id = null;
    private $text = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classe */
        $this->main = new Main();

    }

    public function setMessageId($message_id)
    {

        /** Tratamento dos dados */
        $this->message_id = isset($message_id) ? (int)$this->main->antiInjection($message_id) : 0;

        /** Verificação dos dados */
        if ($this->message_id < 0)
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Message ID", deve ser válido');

        }

    }

    public function setUsuarioId($usuario_id)
    {

        /** Tratamento dos dados */
        $this->usuario_id = isset($usuario_id) ? (int)$this->main->antiInjection($usuario_id) : 0;

        /** Verificação dos dados */
        if ($this->usuario_id < 0)
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Usuário ID", deve ser válido');

        }

    }

    public function setClienteId($cliente_id)
    {

        /** Tratamento dos dados */
        $this->cliente_id = isset($cliente_id) ? (int)$this->main->antiInjection($cliente_id) : 0;

        /** Verificação dos dados */
        if ($this->cliente_id < 0)
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Cliente ID", deve ser válido');

        }

    }

    public function setText($text)
    {

        /** Tratamento dos dados */
        $this->text = isset($text) ? (string)$this->main->antiInjection($text) : null;

        /** Verificação dos dados */
        if (empty($this->text))
        {

            /** Adiciono um elemento a array */
            array_push($this->errors, 'O campo "Mensagem", deve ser válido');

        }

    }

    public function getMessageId()
    {

        return $this->message_id;

    }

    public function getUsuarioId()
    {

        return $this->usuario_id;

    }

    public function getClienteId()
    {

        return $this->cliente_id;

    }

    public function getText()
    {

        return $this->text;

    }

    public function getErrors()
    {

        return $this->errors;

    }

    /** Método destrutor */
    public function __destruct()
    {

        /** Instânciamento de classe */
        $this->main = null;

    }

}
