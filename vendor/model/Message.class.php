<?php

/** Defino o local da classe */
namespace vendor\model;

class Message
{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $message_id = null;
    private $usuario_id = null;
    private $cliente_id = null;
    private $text = null;
    
    /** Construtor da classe */
    public function __construct()
    {

        /** Instânciamento da classe */
        $this->connection = new Firebird();

    }

    /** Listo todos os registros */
    public function all()
    {

        /** SQL de busca */
        $this->sql = 'SELECT * FROM MESSAGE';

        /** Preparo o SQL para exceução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Execução do SQL */
        $this->stmt->execute();

        /** Retorno do resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($message_id, $usuario_id, $cliente_id, $text)
    {

        /** Parâmetros de entrada */
        $this->message_id = $message_id;
        $this->usuario_id = $usuario_id;
        $this->cliente_id = $cliente_id;
        $this->text = $text;

        /** Verifico se é cadastro ou atualização */
        if ($this->message_id == 0)
        {

            /** SQL para inserção */
            $this->sql = 'INSERT INTO MESSAGE(MESSAGE_ID, USUARIO_ID, CLIENTE_ID, TEXT) VALUES((SELECT GEN_ID(MESSAGE_GEN_ID,1) AS ID FROM RDB$DATABASE), :usuario_id, :cliente_id, :text)';

        }
        else{

            /** SQL para atualização */
            $this->sql = 'UPDATE MESSAGE SET USUARIO_ID = :usuario_id, CLIENTE_ID = :cliente_id, TEXT = :text, WHERE MESSAGE_ID = :message_id';

        }

        /** Preparo o SQL para exceução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam('message_id', $this->message_id);
        $this->stmt->bindParam('usuario_id', $this->usuario_id);
        $this->stmt->bindParam('cliente_id', $this->cliente_id);
        $this->stmt->bindParam('text', $this->text);

        /** Execução do SQL */
        return $this->stmt->execute();

    }

    public function delete($message_id)
    {

        /** Parâmetros de entrada */
        $this->message_id = $message_id;

        /** SQL de exclusão */
        $this->sql = 'DELETE FROM MESSAGE WHERE MESSAGE_ID = :message_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':message_id', $this->message_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($message_id)
    {

        /** Parâmetros de entrada */
        $this->message_id = $message_id;

        /** SQL de busca */
        $this->sql = 'SELECT * FROM MESSAGE WHERE MESSAGE_ID = :message_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':message_id', $this->message_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }

}
