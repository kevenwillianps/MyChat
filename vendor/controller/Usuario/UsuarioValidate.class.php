<?php

/** Defino o local da classe */
namespace vendor\controller\Usuario;

/** Importação de classes */
use \vendor\model\Main;

class UsuarioValidate
{

    /** Parâmetros da classe */
    private $main = null;
    private $errors = array();

    private $usuario_id = null;
    private $name = null;
    private $email = null;
    private $password = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classe */
        $this->main = new Main();

    }

    public function setUsuarioId($usuario_id)
    {

        /** Tratamento dos dados de entrada */
        $this->usuario_id = isset($usuario_id) ? (int)$this->main->antiInjection($usuario_id) : 0;

        /** Verifico os dados */
        if ($this->usuario_id < 0)
        {

            /** Adiciono o elemento na array */
            array_push($this->errors, 'O campo "ClienteID", deve ser válido');

        }

    }
    public function setName($name)
    {

        /** Tratamento dos dados de entrada */
        $this->name = isset($name) ? (string)$this->main->antiInjection($name) : null;

        /** Verifico os dados */
        if (empty($this->name))
        {

            /** Adiciono o elemento na array */
            array_push($this->errors, 'O campo "Name", deve ser válido');

        }

    }
    public function setEmail($email)
    {

        /** Tratamento dos dados de entrada */
        $this->email = isset($email) ? (string)$this->main->antiInjection($email) : null;

        /** Verifico os dados */
        if (empty($this->email))
        {

            /** Adiciono o elemento na array */
            array_push($this->errors, 'O campo "Email", deve ser válido');

        }

    }
    public function setPassword($password)
    {

        /** Tratamento dos dados de entrada */
        $this->password = isset($password) ? (string)$this->main->antiInjection($password) : null;

        /** Verifico os dados */
        if (empty($this->password))
        {

            /** Adiciono o elemento na array */
            array_push($this->errors, 'O campo "Senha", deve ser válido');

        }

    }

    public function getUsuarioId()
    {

        return $this->usuario_id;

    }

    public function getName()
    {

        return $this->name;

    }

    public function getEmail()
    {

        return $this->email;

    }

    public function getPassword()
    {

        return $this->password;

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